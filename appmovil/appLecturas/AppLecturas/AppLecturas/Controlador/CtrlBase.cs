using System;
using System.Collections.Generic;
using System.Text;
using Xamarin.Forms;
using Plugin.Connectivity;//contine clases para trabajar con la conectividad a internet

namespace AppLecturas.Controlador
{
    //clase base de la que herdarán el resto de clases del espacio de nombres Controlador
    public class CtrlBase
    {
        public string Servidor { get; set; }//Propiedad para manejar la URL del servidor
        public CtrlBase()//constructor de la clase
        {
            Servidor = "https://weblecturas.000webhostapp.com/api_rest/";//asignar URL donde están alojados los archivos de la apirest
        }
        public bool Esta_Conectado()//devuelve verdadero o falso
        {
            if (CrossConnectivity.Current.IsConnected)//consulta si el dispositivo tiene conección a internet
                return true;//verdadero en caso de ser correcta la conexión
            else 
                return false;//falso si no hay conexión
        }
    }
}
