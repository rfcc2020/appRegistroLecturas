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
    //clase para realizar selección, inserción, modificación y eleiminación de registros de la tabla lectura de la base de datos
    public class CtrlLectura : CtrlBase
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
            try
            {
                return await App.Database.GetLecturaMedidorAsync(IdMedidor);
            }
            catch
            {
                return Enumerable.Empty<ClsLectura>() as List<ClsLectura>;//devuelve una lista vacía
            }
        }
        public async Task<bool> GetLecturaMedidorAsync(DateTime Fecha, int IdMedidor)
        {
            bool resp = false;
            try
            {
                var ListLecturas = await App.Database.GetLecturaAsync(Fecha, IdMedidor);
                foreach (ClsLectura item in ListLecturas)
                {
                    if (item.Fecha.Month == Fecha.Month && item.Fecha.Year == Fecha.Year)
                    {
                        resp = true;
                        break;
                    }
                }
            }
            catch
            {
                return false;
            }
            return resp;
        }
        public async Task<IEnumerable<ClsLectura>> Get()
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
        public async Task<IEnumerable<ClsLectura>> GetNoSincronizados()
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

        public async Task<string> Sincronizar()
        {
            var ListLecturas = await GetNoSincronizados();
            int sinc=0, nsinc = 0;
            Url = Servidor + "srvlecturas.php";
            HttpClient client = getCliente();
            foreach (ClsLectura item in ListLecturas)
            {
                try
                {
                    var formContent = new FormUrlEncodedContent(new[]
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
                    var response = await client.PostAsync(Url, formContent);
                    if (response.IsSuccessStatusCode)
                    {
                        var json = await response.Content.ReadAsStringAsync();
                        ClsLectura result = JsonConvert.DeserializeObject<ClsLectura>(json);
                        await App.Database.UpdateLecturaAsync(item.Id, result.IdServer, "1");
                        sinc++;
                    }
                    else
                        nsinc++;
                }
                catch { nsinc++; }
                }
                
            return "Sincronizados: "+sinc+" No sincronizados: "+nsinc;//devuelve resultado lecturass sincronizadas y no sincronizadas
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
            catch (Exception ex)
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
