using SQLite;
using System;
using System.Collections.Generic;
using System.Text;

namespace AppLecturas.Modelo
{
    //clase que modela la tabla medidor
    public class ClsMedidor:ClsBase
    {
        [PrimaryKey]
        public int Id { get; set; }//propiedad
        public string Codigo { get; set; }
        public string Numero { get; set; }
        public string Marca { get; set; }
        public string Modelo { get; set; }
        public string Imagen { get; set; } 
        public string Sector { get; set; }
        public float Latitud { get; set; }
        public float Longitud { get; set; }
        public int Persona_id { get; set; }
        //public ClsPersona ObjPersona { get; set; }
        public override string ToString()
        {
            return Numero.ToString();
        }
    }
}
