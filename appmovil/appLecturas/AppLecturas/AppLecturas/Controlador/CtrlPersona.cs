using AppLecturas.Modelo;
using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace AppLecturas.Controlador
{
    //clase para realizar selección, inserción, modificación y eliminación en la tabla persona de la base de datos.
    public class CtrlPersona:CtrlBase
    {
        string Url;
        //método para crear la variable cliente que realizará la conexión al servidor usando el protocolo http
        private HttpClient getCliente()
        {
            HttpClient client = new HttpClient();
            client.DefaultRequestHeaders.Add("Accept", "application/json");
            client.DefaultRequestHeaders.Add("Connection", "close");
            return client;
        }
        
        //método asíncrono que devuelve un objeto enumerable(lista) de tipo clspersona filtrado por cédula, del paquete modelo
        public async Task<IEnumerable<ClsPersona>> ConsultarCi(string Ci)
        {
            return await App.Database.GetPersonaAsync(Ci);
        }
        //método asíncrono que devuelve un objeto enumerable(lista) de tipo clspersona filtrado por cédula, del paquete modelo
        public async Task<IEnumerable<ClsPersona>> ConsultarId(int Id)
        {
            return await App.Database.GetPersonaAsync(Id);
        }
        private async Task<IEnumerable<ClsPersona>> GetNuevos()
        {
            List<ClsPersona> ListPersonas = await App.Database.GetPersonaAsync();
            string StrIds = "";
            if (ListPersonas.Count > 0)
            {
                foreach (ClsPersona item in ListPersonas)
                {
                    StrIds = StrIds + item.Id + ",";
                }
                StrIds = StrIds.Substring(0, StrIds.Length - 1);
            }
            else
                StrIds = "0";
            //llamada al script php para consultar los usuarios, devuelve un objeto tipo json de la tabla usuario    
            Url = "http://" + Servidor + "/applecturas/logica/personas/sync_server.php" +
                "?StrIds=" + StrIds;
            HttpClient client = getCliente();
            var resp = await client.GetAsync(Url);
            if (resp.IsSuccessStatusCode)//si el codigo devuelto es satisfactorio se devuelve un objeto enumerable
            {
                string content = await resp.Content.ReadAsStringAsync();
                return JsonConvert.DeserializeObject<IEnumerable<ClsPersona>>(content);//retorna un objeto json desserializado
            }
            return Enumerable.Empty<ClsPersona>();//devuelve una lista vacía
        }
        public async Task<bool> SincronizarAsync()
        {
            var Consulta = await GetNuevos();
            if (Consulta != null)
            {
                foreach (ClsPersona item in Consulta)
                {
                    await App.Database.SavePersonaAsync(item);
                }
                return true;
            }
            return false;
        }
    }
}
