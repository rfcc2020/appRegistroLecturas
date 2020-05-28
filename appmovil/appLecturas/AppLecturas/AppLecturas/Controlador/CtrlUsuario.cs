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
    //clase para realizar selección, inserción, modificación y eliminación en la tabla usuario de la base de datos.
    public class CtrlUsuario:CtrlBase
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
        //método asíncrono que devuelve un objeto enumerable(lista) de tipo clsusuario del paquete modelo filtrado por id de perfil
        private async Task<IEnumerable<ClsUsuario>> GetNuevos()
        {
            try
            {
                List<ClsUsuario> ListUsuarios = await App.Database.GetUsuarioAsync();
                string StrIds = "";
                if (ListUsuarios.Count > 0)
                {
                    foreach (ClsUsuario item in ListUsuarios)
                    {
                        StrIds = StrIds + item.Id + ",";
                    }
                    StrIds = StrIds.Substring(0, StrIds.Length - 1);
                }
                else
                    StrIds = "0";
                //llamada al script php para consultar los usuarios, devuelve un objeto tipo json de la tabla usuario    
                Url = Servidor + "srvusuarios.php" +
                    "?StrIds=" + StrIds;
                HttpClient client = getCliente();
                var resp = await client.GetAsync(Url);
                if (resp.IsSuccessStatusCode)//si el codigo devuelto es satisfactorio se devuelve un objeto enumerable
                {
                    string content = await resp.Content.ReadAsStringAsync();
                    return JsonConvert.DeserializeObject<IEnumerable<ClsUsuario>>(content);//retorna un objeto json desserializado
                }
            }
            catch
            {
                return Enumerable.Empty<ClsUsuario>();//devuelve una lista vacía
            }
            return Enumerable.Empty<ClsUsuario>();//devuelve una lista vacía
        }
        public async Task<bool> SincronizarAsync()
        {
            try
            {
                var Consulta = await GetNuevos();
                if (Consulta != null)
                {
                    foreach (ClsUsuario item in Consulta)
                    {
                        await App.Database.SaveUsuarioAsync(item);
                    }
                    return true;
                }
            }
            catch { return false; }
            
            return false;
        }
        //método asíncrono que devuelve un objeto enumerable(lista) de tipo clsusuario del paquete modelo filtrado por email y password (login)
        public async Task<IEnumerable<ClsUsuario>> LoginUsr(string email)
        {
            try
            {
                List<ClsUsuario> ObjUsr = await App.Database.LoginUsuarioAsync(email);
                return ObjUsr;
            }
            catch 
            {
                return Enumerable.Empty<ClsUsuario>();//devuelve una lista vacía 
            }
        }   
    }
}
