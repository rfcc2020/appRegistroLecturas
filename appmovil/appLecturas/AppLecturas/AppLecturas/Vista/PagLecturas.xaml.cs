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
            listView.ItemsSource = await Manager.Get();
            
        }

        private void listView_ItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            ClsLectura ObjLectura = e.SelectedItem as ClsLectura;//asignar el objeto seleccionado a la variable obj
            //((NavigationPage)this.Parent).PushAsync(new PagIngresoLectura(ObjLectura, false));//mostrar la vista adminpersona con los datos cargados para modificar o eliminar
        }

        private async void Button_Clicked_SincronizarAsync(object sender, EventArgs e)
        {
            try
            {
                await Manager.Sincronizar();
            }
            catch(Exception x)
            {
                await DisplayAlert("Error", x.Message, "ok");
            }
        }
    }
}