using AppLecturas.Modelo;
using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace AppLecturas.Controlador
{
    //clase para interactuar entre la interfaz de usuario y el modelo de base de datos local y remoto
    public class CtrlLectura : CtrlBase//hereda de ctrlbase
    {
        string Url;
        //método para crear la variable cliente que realizará la conexión al servidor remoto usando el protocolo http
        private HttpClient getCliente()
        {
            HttpClient client = new HttpClient();
            client.DefaultRequestHeaders.Add("Accept", "application/json");
            client.DefaultRequestHeaders.Add("Connection", "close");
            return client;
        }

        //método para obtener la lectura anterior de un medidor
        public async Task<List<ClsLectura>> ConsultarAnterior(int IdMedidor)
        {
            try
            {
                return await App.Database.GetLecturaMedidorAsync(IdMedidor);//invoca al método de la clase Database
            }
            catch
            {
                return Enumerable.Empty<ClsLectura>() as List<ClsLectura>;//devuelve una lista vacía
            }
        }
        //método para consultar si un medidor ya tiene un registro correspondiente al mes y año actual
        public async Task<bool> GetLecturaMedidorAsync(DateTime Fecha, int IdMedidor)
        {
            bool resp = false;
            try
            {
                var ListLecturas = await App.Database.GetLecturaAsync(IdMedidor);//consulta las lecturas que corresponde al id de medidor
                foreach (ClsLectura item in ListLecturas)//recorrer el listado de lecturas
                {
                    if (item.Fecha.Month == Fecha.Month && item.Fecha.Year == Fecha.Year)//si la fecha del registro coincide con el año y mes actual devuelve true y termina el método
                    {
                        resp = true;//devuelve verdadero
                        break;
                    }
                }
            }
            catch
            {
                return false;//si hay error devuelve falso
            }
            return resp;//si no encuentra ningún registro devuelve falso
        }
        public async Task<IEnumerable<ClsLectura>> Get()//consultar listado de lecturas
        {
            try
            {
                return await App.Database.GetLecturaAsync();
            }
            catch
            {
                return Enumerable.Empty<ClsLectura>();//devuelve una lista vacía
            }
        }
        public async Task<IEnumerable<ClsLectura>> GetNoSincronizados()//consultar lecturas con estado 0
        {
            try
            {
                return await App.Database.GetLecturaAsync("0");
            }
            catch
            {
                return Enumerable.Empty<ClsLectura>();//devuelve una lista vacía
            }
        }

        public async Task<string> Sincronizar()//método para sincronizar con servidor remoto
        {
            var ListLecturas = await GetNoSincronizados();//obtener lecturas con estado = 0
            int sinc=0, nsinc = 0;//variables para mostrar resultado sinc=sincronizados, nsinc=no sincronizados
            Url = Servidor + "srvlecturas.php";//armar la url con la dirección del sevidor y el script srvlecturas.php
            HttpClient client = getCliente();//crear un nuevo objeto tipo cliente http
            foreach (ClsLectura item in ListLecturas)//recorrer el listado de lecturas no sincronizadas
            {
                try
                {
                    var formContent = new FormUrlEncodedContent(new[]//armar un formulario con los datos del objeto
                {
                new KeyValuePair<string, string>("Fecha", item.Fecha.Year + "/"+item.Fecha.Month+"/"+item.Fecha.Day),
                new KeyValuePair<string, string>("Anterior", item.Anterior.ToString()),
                new KeyValuePair<string, string>("Actual", item.Actual.ToString()),
                new KeyValuePair<string, string>("Consumo", item.Consumo.ToString()),
                new KeyValuePair<string, string>("Basico", item.Basico.ToString()),
                new KeyValuePair<string, string>("Exceso", item.Exceso.ToString()),
                new KeyValuePair<string, string>("Observacion", item.Observacion.ToString()),
                new KeyValuePair<string, string>("Imagen", item.StrImagen),
                new KeyValuePair<string, string>("Latitud", item.Latitud.ToString()),
                new KeyValuePair<string, string>("Longitud", item.Longitud.ToString()),
                new KeyValuePair<string, string>("Estado", "A"),
                new KeyValuePair<string, string>("Medidor_id", item.Medidor_id.ToString()),
                new KeyValuePair<string, string>("User_id", item.User_id.ToString()),
                new KeyValuePair<string, string>("Created_at", item.Created_at.Year+"/"+item.Created_at.Month+"/"+item.Created_at.Day),
                new KeyValuePair<string, string>("Updated_at", item.Updated_at.Year+"/"+item.Updated_at.Month+"/"+item.Updated_at.Day),
            });
                    var response = await client.PostAsync(Url, formContent);//enviar la petición http al servidor remoto y recoger el resultado en la variable response
                    if (response.IsSuccessStatusCode)//si la respuesta viene con código correcto 
                    {
                        var json = await response.Content.ReadAsStringAsync();//recibe la respuesta en formato json
                        ClsLectura result = JsonConvert.DeserializeObject<ClsLectura>(json);//result objeto de la clase clslectura 
                        await App.Database.UpdateLecturaAsync(item.Id, result.IdServer, "1");//actualizar el registro de la tabla clslectura
                        sinc++;//incremento 
                    }
                    else
                        nsinc++;
                }
                catch { nsinc++; }
                }
                
            return "Sincronizados: "+sinc+" No sincronizados: "+nsinc;//devuelve resultado lecturass sincronizadas y no sincronizadas
        }

        //método elimina registros en la tabla lectura de la base de datos
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
        //guardar una nueva lectura
        public async Task<string> SaveAsync(ClsLectura ObjLectura)//recibe un objeto de la clase clslectura
        {
            try
            {
                ObjLectura.Estado = "0";//defecto
                ObjLectura.Calcular();//llamada a método calcular
                await App.Database.SaveLecturaAsync(ObjLectura);
                return "ok";
            }
            catch (Exception ex)
            {
                return ex.Message;
            }
        }
        //actualizar una lectura
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
