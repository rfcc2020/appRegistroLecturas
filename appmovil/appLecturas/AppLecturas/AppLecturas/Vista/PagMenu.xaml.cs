using AppLecturas.Modelo;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using AppLecturas.Controlador;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using System.Threading;

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
        //metodo que se ejecuta cuando se muestra la interfaz
        protected override async void OnAppearing()
        {
            base.OnAppearing();
            CtrlLectura ObjCtrlLectura = new CtrlLectura();

            try
            {
                // cada vez que se muestre el menú se busca lecturas para sincronizar
                if (ObjCtrlLectura.Esta_Conectado())
                {
                    await SincronizarLecturasAsync();
                    var StrMensaje = await ObjCtrlLectura.Sincronizar();
                    TxtConectado.Text = "SI";
                    TxtSincronizacion.Text = StrMensaje;
                }
                else
                {
                    TxtConectado.Text = "NO";
                    TxtSincronizacion.Text = "";
                }

                }
                catch (Exception ex)
                {
                    TxtSincronizacion.Text = ex.Message;
                }

        }
        //controlador del botón cerrar evento clic
        private void ButCerrarSesion_Clicked(object sender, EventArgs e)
        {
            App.Current.Logout();
        }
        //maneja la seleccion de un medidor del listado
        private async void listView_ItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            try
            {
                ClsMedidor ObjMedidor = e.SelectedItem as ClsMedidor;//asignar el objeto seleccionado a la variable obj
                CtrlLectura ObjCtrlLectura = new CtrlLectura();
                var LecturaMes = await ObjCtrlLectura.GetLecturaMedidorAsync(DateTime.Today, ObjMedidor.Id);
                
                if (!LecturaMes)
                    await ((NavigationPage)this.Parent).PushAsync(new PagIngresoLectura(ObjMedidor, true));//mostrar la vista adminpersona con los datos cargados para modificar o eliminar
                else
                    await DisplayAlert("Mensaje", "Ya se han ingresado datos de este mes para el medidor seleccionado", "ok");
            }
            catch(Exception ex)
            {
                await DisplayAlert("Mensaje", ex.Message, "ok");
            }
        }
        //maneja boton consultar medidores 
        private async void ButConsultaMedidores_ClickedAsync(object sender, EventArgs e)
        {
            CtrlMedidor Manager = new CtrlMedidor();
            try
            {
                if (Manager.Esta_Conectado())
                    await SincronizarMedidoresAsync();
                else
                    TxtConectado.Text = "No";
                listView.ItemsSource = await Manager.Consultar(ObjMiUsuario.Sector);//consulta medidores por sectora asignado al usuario
            }catch(Exception ex)
            {
                await DisplayAlert("Mensaje", ex.Message, "ok");
            }
        }

        protected async Task<bool> SincronizarMedidoresAsync()//sincroniza medidores
        {
            try
            {
                CtrlMedidor ObjCtrlMedidor = new CtrlMedidor();
                bool IsValid = await ObjCtrlMedidor.SincronizarAsync();
                return IsValid;
            }
            catch
            {
                return false;
            }
        }
        protected async Task<bool> SincronizarLecturasAsync()//sincroniza lecturas
        {
            try
            {
                CtrlLectura ObjCtrlLectura = new CtrlLectura();
                bool IsValid = await ObjCtrlLectura.SincronizarAsync();
                return IsValid;
            }
            catch
            {
                return false;
            }
        }
        //boton que lleva a la interfaz listado de lecturas
        private void ButConsultarLectura_Clicked(object sender, EventArgs e)
        {
            ((NavigationPage)this.Parent).PushAsync(new PagLecturas());
        }
    }
}