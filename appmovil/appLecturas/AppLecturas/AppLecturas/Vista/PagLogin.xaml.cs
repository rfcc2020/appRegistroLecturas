﻿using AppLecturas.Controlador;
using AppLecturas.Interfaces;
using AppLecturas.Modelo;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Threading;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace AppLecturas.Vista
{
    //clase que maneja la vista login
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class PagLogin : ContentPage
    {
        ILoginManager Ilm = null;//instancia de interfaz 
        public PagLogin(ILoginManager Ilm)//constructor recibiendo como parámetro objeto de clase interfaz Iloginmanager
        {
            InitializeComponent();
            this.Ilm = Ilm;//asignar variable local
        }
        //metodo que se ejecuta cuando se muestra la interfaz
        protected override async void OnAppearing()
        {
            base.OnAppearing();
            bool IsValidSyncUsuarios = await SincronizarUsuariosAsync();
            if (!IsValidSyncUsuarios)
                TxtMsg.Text = "No se ha podido recuperar la información del origen remoto";
            else
                TxtMsg.Text = "Información recuperada correctamente desde el origen remoto";
        }
        public PagLogin()//constructor
        {
            InitializeComponent();
        }
        /// Encripta una cadena
        private bool VerificarPassword(string StrEncPassword, string UsrPassword)
        {
            bool isValid = BCrypt.Net.BCrypt.Verify(StrEncPassword, UsrPassword);
            return isValid;
        }
        //manejador evento clic del botón entrar
        private async void ButEntrar_Clicked(object sender, EventArgs e)
        {
            CtrlUsuario ObjCtrlUsuario = new CtrlUsuario();//instancia de controlador
            try
            {
                if (!string.IsNullOrWhiteSpace(TxtEmail.Text))//validar email no nulo
                    if (!string.IsNullOrWhiteSpace(TxtPassword.Text))//validar password no nulo
                        if (TxtEmail.TextColor == Color.Green)//validar email con formato correcto
                            if (TxtPassword.Text.Length >= 6) //(TxtPassword.TextColor == Color.Black)//validar password con formato correcto
                            {
                               var ConsUsr = await ObjCtrlUsuario.LoginUsr(TxtEmail.Text);//invoca al método login del controlador usuario
                                if (ConsUsr.Count() == 1)//si existe un registro que coincide con el email
                                {
                                    bool PassValido = false;
                                    foreach (ClsUsuario item in ConsUsr)//recorrer la lista
                                    {
                                        if (VerificarPassword(TxtPassword.Text, item.Password))//verificar password
                                        {
                                            PassValido = true;//cuando se encuentra el password
                                            break;
                                        }
                                    }
                                    if (PassValido)//si el password es valido se continua
                                    {
                                        await SincronizarPersonasAsync();
                                        ClsUsuario ObjUsuario = ConsUsr.First();
                                        await DisplayAlert("Mensaje", "Bienvenido", "ok");//mensaje de  bienvenida
                                                                                          //ObjUsuario.ObjPerfil = ConsPerfil.First();//asignar objeto encontrado a campo de objeto usuario
                                        App.Current.Properties["name"] = ObjUsuario.Name;//guardar en propiedades de la aplicación el nombre del usuario
                                        App.Current.Properties["IsLoggedIn"] = true;//guardar en propiedades de la aplicación el estado como verdadero
                                        App.Current.Properties["ObjUsuario"] = ObjUsuario;//guardar el objeto usuario en propiedades de la aplicación
                                        Ilm.ShowMainPage();


                                    }
                                    else
                                        await DisplayAlert("Mensaje", "Datos no encontrados, vuelva a intentar", "ok");
                                }
                                else
                                        await DisplayAlert("Mensaje", "Datos no encontrados, vuelva a intentar", "ok");
                            }
                            else
                                await DisplayAlert("Mensaje", "Password con formato incorrecto", "ok");
                        else
                            await DisplayAlert("Mensaje", "Email con formato incorrecto", "ok");
                    else
                        await DisplayAlert("Mensaje", "Debe ingresar el password", "ok");
                else
                    await DisplayAlert("Mensaje", "Debe ingresar el email", "ok");
            }
            catch (Exception x) { await DisplayAlert("Mensaje", x.Message, "ok"); }
        }
        private void ButCancelar_Clicked(object sender, EventArgs e)
        {
            TxtEmail.Text = "";
            TxtPassword.Text = "";
        }
        //sincronizar los abonados
        protected async Task<bool> SincronizarPersonasAsync()
        {
            try
            {
                CtrlPersona ObjCtrlPersona = new CtrlPersona();
                if (ObjCtrlPersona.Esta_Conectado())
                    return await ObjCtrlPersona.SincronizarAsync();
                else
                    return false;
            }
            catch
            {
                return false;
            }
        }
        //sincronizar los usuarios
        protected async Task<bool> SincronizarUsuariosAsync()
        {
            try
            {
                CtrlUsuario ObjCtrlUsuario = new CtrlUsuario();
                if (ObjCtrlUsuario.Esta_Conectado())
                    return await ObjCtrlUsuario.SincronizarAsync();
                else return false;
            }
            catch
            {
                return false;
            }
        }
        
    }
}