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

namespace AppLecturas.Vista
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class PagLecturas : ContentPage
    {
        CtrlLectura Manager;
        public PagLecturas()
        {
            InitializeComponent();
            Manager = new CtrlLectura();
        }
        void OnButtonClicked(object sender, EventArgs e)
        {
            ClsLectura Obj = new ClsLectura
            {
                Created_at = DateTime.Now,//asigna fecha actual
                Updated_at = DateTime.Now
            };//nueva instancia clase clslectura
            //((NavigationPage)this.Parent).PushAsync(new PagIngresoLectura(Obj, true));//mostrar vista ingresolectura*/
        }

        private async void Button_ClickedAsync(object sender, EventArgs e)
        {
            try
            {
                listView.ItemsSource = await Manager.Get();
            }
            catch(Exception ex)
            {
                await DisplayAlert("Error", ex.Message, "ok");
            }

        }

        private async void listView_ItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            try
            {
                ClsLectura ObjLectura = e.SelectedItem as ClsLectura;//asignar el objeto seleccionado a la variable obj
                await ((NavigationPage)this.Parent).PushAsync(new PagIngresoLectura(ObjLectura, false));//mostrar la vista adminpersona con los datos cargados para modificar o eliminar
            }
            catch(Exception ex)
            {
                await DisplayAlert("Error", ex.Message, "ok");
            }
        }

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