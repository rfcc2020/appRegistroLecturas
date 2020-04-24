using Newtonsoft.Json;
using SQLite;
using System;
using System.Collections.Generic;
using System.IO;
using System.Runtime.Serialization;
using System.Text;
using Xamarin.Essentials;

namespace AppLecturas.Modelo
{
    //clase que modela la tabla lectura
    public class ClsLectura:ClsBase
    {
        [PrimaryKey, AutoIncrement]
        public int Id { get; set; }
        public DateTime Fecha { get; set; }
        public float Anterior { get; set; }
        public float Actual { get; set; }
        public float Consumo { get; set; }
        public float Basico { get; set; }
        public float Exceso { get; set; }
        public string Observacion { get; set; }

        
        public double Latitud { get; set; }
        public double Longitud { get; set; }
        public int Medidor_id { get; set; }
        public int User_id { get; set; }
        public int IdServer { get; set; }
        
        private float CantidadConsumo = 5;
        private float ValorConsumo = 4;
        private float VaLorExceso = 5;
        public float Total { get; set; }
        
        [JsonIgnore]
        [IgnoreDataMember]
        public string Imagen { get; set; }

        [JsonIgnore]
        [IgnoreDataMember]
        public Xamarin.Forms.ImageSource Image
        {
            get 
            {
                if(Imagen != null)
                return Xamarin.Forms.ImageSource.FromStream(
                    () => new MemoryStream(Convert.FromBase64String(Imagen)));
                return null;
            }
        }

        public void Calcular()//método para calcular consumo, exceso y valores según la lectura anterior y la lectura actual
        {
            Consumo = Actual - Anterior;
            Basico = ValorConsumo;
            if (Consumo > CantidadConsumo)
            {                
                Exceso = (Consumo - CantidadConsumo) * VaLorExceso;
            }
            else
            {
                Exceso = 0; 
            }
            Total = Basico + Exceso;
        }

        public async void Localizar()
        {
            try
            {
                var request = new GeolocationRequest(GeolocationAccuracy.Medium);
                var location = await Geolocation.GetLocationAsync(request);

                if (location != null)
                {
                    this.Latitud = location.Latitude;
                    this.Longitud = location.Longitude;
                }
            }
            catch (FeatureNotSupportedException fnsEx)
            {
                // Handle not supported on device exception
            }
            catch (FeatureNotEnabledException fneEx)
            {
                // Handle not enabled on device exception
            }
            catch (PermissionException pEx)
            {
                // Handle permission exception
            }
            catch (Exception ex)
            {
                // Unable to get location
            }
        }
        
    }
}
