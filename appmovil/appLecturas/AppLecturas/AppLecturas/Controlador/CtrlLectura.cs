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
    //clase para realizar selección, inserción, modificación y eleiminación de registros de la tabla lectura de la base de datos
    public class CtrlLectura:CtrlBase
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
        
        //método que invoca al script php que consulta la lectura anterior filtrado por el código de medidor de la tabla lectura
        public async Task<List<ClsLectura>> ConsultarAnterior(int IdMedidor)
        {
            return await App.Database.GetLecturaMedidorAsync(IdMedidor);
        }
        
        public async Task<IEnumerable<ClsLectura>> Get()
        {
            return await App.Database.GetLecturaAsync();
        }
        public async Task<IEnumerable<ClsLectura>> GetNoSincronizados()
        {
            return await App.Database.GetLecturaAsync("0");
        }
        public async Task<string> Sincronizar()
        {
            var ListLecturas = await GetNoSincronizados();
            string TxtJSON = JsonConvert.SerializeObject(ListLecturas, Formatting.Indented);
            Url = "http://" + Servidor + "/applecturas/logica/lectura/sync_app.php" +
                "?TxtJSON=" + TxtJSON;
            HttpClient client = getCliente();
            var resp = await client.GetAsync(Url);
            if (resp.IsSuccessStatusCode)//si el codigo devuelto es satisfactorio se devuelve un objeto enumerable
            {
                string content = await resp.Content.ReadAsStringAsync();
                var ListLecturasSinc = JsonConvert.DeserializeObject<IEnumerable<ClsLectura>>(content);//retorna un objeto json desserializado
                foreach (ClsLectura item in ListLecturasSinc)
                {
                    await App.Database.UpdateLecturaAsync(item.Id, item.IdServer, item.Estado);
                }
            }
            return "0";//devuelve una lista vacía
        }
        //método que invoca al script que elimina registros en la tabla lectura de la base de datos
        public async Task<string> DeleteAsync(ClsLectura ObjLectura)
        {
            try
            {
                await App.Database.DeleteLecturaAsync(ObjLectura);
                return "ok";
            }
            catch (Exception ex)
            {
                return ex.Message;
            }
        }

        public async Task<string> SaveAsync(ClsLectura ObjLectura)
        {
            try
            {
                ObjLectura.Estado = "0";
                ObjLectura.Calcular();
                await App.Database.SaveLecturaAsync(ObjLectura);
                return "ok";
            }
            catch(Exception ex)
            {
                return ex.Message;
            }
        }
        public async Task<string> UpdateAsync(ClsLectura ObjLectura)
        {
            try
            {
                ObjLectura.Calcular();
                await App.Database.UpdateLecturaAsync(ObjLectura);
                return "ok";
            }
            catch (Exception ex)
            {
                return ex.Message;
            }
        }
    }
}
