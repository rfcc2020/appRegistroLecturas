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
    //clase para realizar selección, inserción, modificación y eliminación en la tabla medidor de la base de datos.
    public class CtrlMedidor:CtrlBase
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
        //método asíncrono que devuelve un objeto enumerable(lista) de tipo clsmedidor del paquete modelo
        public async Task<IEnumerable<ClsMedidor>> Consultar(string Sector)
        {
            try
            {
                return await App.Database.GetMedidorAsync(Sector);
            }
            catch
            {
                return Enumerable.Empty<ClsMedidor>();//devuelve una lista vacía }
            }
        }
        //método asíncrono que devuelve un objeto enumerable(lista) de tipo clsmedidor del paquete modelo
        public async Task<IEnumerable<ClsMedidor>> Consultar(int Id)
        {
            try
            {
                return await App.Database.GetMedidorAsync(Id);
            }
            catch
            {
                return Enumerable.Empty<ClsMedidor>();//devuelve una lista vacía }
            }
        }
        //método que invoca al script php que consulta un un medidor filtrado por el id de persona asignada.
        public async Task<IEnumerable<ClsMedidor>> ConsultarIdPersona(int IdPersona)
        {
            try
            {
                return await App.Database.GetMedidorPersonaAsync(IdPersona);
            }
            catch
            {
                return Enumerable.Empty<ClsMedidor>();//devuelve una lista vacía }
            }
        }
        //método asíncrono que devuelve un objeto enumerable(lista) de tipo clsusuario del paquete modelo filtrado por id de perfil
        //método asíncrono que devuelve un objeto enumerable(lista) de tipo clsusuario del paquete modelo filtrado por id de perfil
        private async Task<IEnumerable<ClsMedidor>> GetNuevos()
        {
            try
            {
                List<ClsMedidor> ListMedidores = await App.Database.GetMedidorAsync();
                string StrIds = "";
                if (ListMedidores.Count > 0)
                {
                    foreach (ClsMedidor item in ListMedidores)
                    {
                        StrIds = StrIds + item.Id + ",";
                    }
                    StrIds = StrIds.Substring(0, StrIds.Length - 1);
                }
                else
                    StrIds = "0";
                //llamada al script php para consultar los usuarios, devuelve un objeto tipo json de la tabla usuario    
                Url = Servidor + "srvmedidores.php" +
                    "?StrIds=" + StrIds;
                HttpClient client = getCliente();
                var resp = await client.GetAsync(Url);
                if (resp.IsSuccessStatusCode)//si el codigo devuelto es satisfactorio se devuelve un objeto enumerable
                {
                    string content = await resp.Content.ReadAsStringAsync();
                    return JsonConvert.DeserializeObject<IEnumerable<ClsMedidor>>(content);//retorna un objeto json desserializado
                }
            }
            catch
            {
                return Enumerable.Empty<ClsMedidor>();//devuelve una lista vacía
            }
            return Enumerable.Empty<ClsMedidor>();//devuelve una lista vacía
        }
        public async Task<bool> SincronizarAsync()
        {
            try
            {
                var Consulta = await GetNuevos();
                if (Consulta != null)
                {
                    foreach (ClsMedidor item in Consulta)
                    {
                        await App.Database.SaveMedidorAsync(item);
                    }
                    return true;
                }
            }
            catch { return false; }
            return false;
        }
}
}
