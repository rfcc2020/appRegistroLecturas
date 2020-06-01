using AppLecturas.Modelo;
using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;
using System.Threading;

namespace AppLecturas.Controlador
{
    //clase para interactuar entre la interfaz de usuario y la tabla ClsUsuario de la base de datos.
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
        //método asíncrono que devuelve un listado de Usuarios que aún no han sido sincronizados entre la base local y la remota
        private async Task<IEnumerable<ClsUsuario>> GetNuevos()
        {
            try
            {
                List<ClsUsuario> ListUsuarios = await App.Database.GetUsuarioAsync();//consulta de los medidores almacenados
                //en la base de datos local
                string StrIds = "";//varible tipo cadena para guardar los Id existentes en local
                if (ListUsuarios.Count > 0)//si el listado de medidores es mayor que cero
                {
                    foreach (ClsUsuario item in ListUsuarios)
                    {
                        StrIds = StrIds + item.Id + ",";//se arma una cadena de Ids separado por coma(,)
                    }
                    StrIds = StrIds.Substring(0, StrIds.Length - 1);
                }
                else
                    StrIds = "0";//si no hay datos asigno el valor 0 a la cadena 
                //se define la url a la que apunta la petición, indicando el script srvusuarios.php que recibe como parametro 
                //la cadena de ids ya registrados
                Url = Servidor + "srvusuarios.php" +
                    "?StrIds=" + StrIds;
                //creación de un nuevo objeto Httpclient para hacer la solicitud al servidor remoto
                HttpClient client = getCliente();
                //ejecuta la petición Get al servidor remoto, pasando la url como parámetro
                var resp = await client.GetAsync(Url);
                
                if (resp.IsSuccessStatusCode)//si el codigo devuelto es satisfactorio 
                {
                    string content = await resp.Content.ReadAsStringAsync();//se lee el contenido de la respuesta del servidor
                    return JsonConvert.DeserializeObject<IEnumerable<ClsUsuario>>(content);//transforma el contenido de respuesta
                    //de formato json a listado de objetos de la clase ClsUsuario
                }
                else
                    return Enumerable.Empty<ClsUsuario>();//devuelve una lista vacía
            }
            catch(Exception ex)
            {
                throw new Exception("Error al consultar informacion del origen remoto. Razon: "+ex.Message);//devuelve una lista vacía
            }
        }
        public async Task<bool> SincronizarAsync()//método para sincronizar usuarios entre la base local y la remota
        {
            try
            {
                var Consulta = await GetNuevos();//consulta los usuarios nuevos
                if (Consulta != null)//si la consulta tiene datos
                {
                    foreach (ClsUsuario item in Consulta)//recorrer la consulta
                    {
                        await App.Database.SaveUsuarioAsync(item);//almacenar cada objeto en la base de datos local
                    }
                    return true;
                }
            }
            catch(Exception ex) {
                throw new Exception("Error al consultar informacion del origen remoto. Razon: " + ex.Message);//devuelve error 
            }

            return false;
        }
        //método asíncrono que devuelve un objeto enumerable(lista) de tipo clsusuario del paquete modelo filtrado por email
        public async Task<IEnumerable<ClsUsuario>> LoginUsr(string email)
        {
            try
            {
                List<ClsUsuario> ObjUsr = await App.Database.LoginUsuarioAsync(email);
                return ObjUsr;
            }
            catch (Exception ex)
            {
                throw new Exception("Error al consultar informacion del origen remoto. Razon: " + ex.Message);//devuelve error
            }
        }   
    }
}
