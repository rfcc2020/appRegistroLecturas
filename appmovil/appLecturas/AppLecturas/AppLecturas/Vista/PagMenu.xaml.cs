using AppLecturas.Modelo;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using AppLecturas.Controlador;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace AppLecturas.Vista
{
    //clase que maneja la vista menú
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class PagMenu : ContentPage
    {
        private ClsUsuario ObjMiUsuario;//variable local usuario autenticado
        public PagMenu()
        {
            InitializeComponent();
            this.ObjMiUsuario = App.Current.Properties["ObjUsuario"] as ClsUsuario;//recuperar objeto guardado en propieades de la aplicación
            TxtUsuario.Text = ObjMiUsuario.Name;//mostrar en caja de texto el nombre de la persona
            TxtPerfil.Text = ObjMiUsuario.Role;//mostrar el nombre del perfil en una caja de texto
            TxtSector.Text = ObjMiUsuario.Sector;//mostrar el sector asignado al usuario
        }
        //controlador del botón cerrar evento clic
        private void ButCerrarSesion_Clicked(object sender, EventArgs e)
        {
            App.Current.Logout();
        }
        
        private void listView_ItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            ClsMedidor ObjMedidor = e.SelectedItem as ClsMedidor;//asignar el objeto seleccionado a la variable obj
            ((NavigationPage)this.Parent).PushAsync(new PagIngresoLectura(ObjMedidor, true));//mostrar la vista adminpersona con los datos cargados para modificar o eliminar
        }

        private async void ButConsultaMedidores_ClickedAsync(object sender, EventArgs e)
        {
            CtrlMedidor Manager = new CtrlMedidor();
            listView.ItemsSource = await Manager.Consultar(ObjMiUsuario.Sector);
        }

        private void ButConsultarLectura_Clicked(object sender, EventArgs e)
        {
            ((NavigationPage)this.Parent).PushAsync(new PagLecturas());
        }
    }
}