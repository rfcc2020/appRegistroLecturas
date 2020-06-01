using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using AppLecturas.Modelo;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using AppLecturas.Controlador;
//interfaz que muestra el listado de lecturas almacenadas en el dispositivo
namespace AppLecturas.Vista
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class PagLecturas : ContentPage
    {
        CtrlLectura Manager;//objeto de la clase ctrllectura
        public PagLecturas()
        {
            InitializeComponent();
            ButSincr.IsVisible = false;
            Manager = new CtrlLectura();
        }
        //manejador del boton listar
        private async void Button_ClickedAsync(object sender, EventArgs e)
        {
            try
            {
                listView.ItemsSource = await Manager.Get();//consulta la lecturas y las asigna al objeto listview
            }
            catch(Exception ex)
            {
                await DisplayAlert("Error", ex.Message, "ok");
            }

        }
        //controlador del evento seleccion de una lectura del listado
        private async void listView_ItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            try
            {
                ClsLectura ObjLectura = e.SelectedItem as ClsLectura;//asignar el objeto seleccionado a la variable obj
                await ((NavigationPage)this.Parent).PushAsync(new PagIngresoLectura(ObjLectura, false));//mostrar la vista ingreso de lectura con los datos cargados
            }
            catch(Exception ex)
            {
                await DisplayAlert("Error", ex.Message, "ok");
            }
        }
        //controlador del botón sincronizar
        private async void Button_Clicked_SincronizarAsync(object sender, EventArgs e)
        {
            try
            {
               var StrMensaje = await Manager.Sincronizar();
               await DisplayAlert("Información", StrMensaje, "ok");
            }
            catch(Exception ex)
            {
                await DisplayAlert("Error", ex.Message, "ok");
            }
        }
    }
}