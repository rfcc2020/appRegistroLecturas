﻿using AppLecturas.Controlador;
using AppLecturas.Modelo;
using Plugin.Media.Abstractions;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using XamarinCamara.Servicios;

namespace AppLecturas.Vista
{
    //vista para el ingreso de lecturas de consumo de agua
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class PagIngresoLectura : ContentPage
    {
        bool opc;
        ClsLectura ObjLectura;
        CtrlPersona ObjCtrlPersona;
        ClsPersona ObjPersona;
        CtrlLectura manager;
        ClsMedidor ObjMedidor;
        ClsUsuario ObjUsuario;
        //Manejo de camara
        public static readonly BindableProperty RutaFotoProperty = BindableProperty.Create(
                  "RutaFoto",
                  typeof(string),
                  typeof(PagIngresoLectura),
                  default(string));
        public string RutaFoto
        {
            get
            {
                return (string)GetValue(RutaFotoProperty);
            }
            set
            {
                SetValue(RutaFotoProperty, value);
            }
        }

        private MediaFile Foto;//variable que almacena la foto

        public Command m_seleccionarFotoComand;//representa seleccion o ejecucion de aplicación cámara

        public async void SeleccionarFotoAsync(object sender, EventArgs e)//cuando se requiere seleccionar una foto
        {
            int nErrores = 0;
            try
            {
                Foto = await ServicioFoto.Instancia.SeleccionarFotoAsync();
                if (Foto != null)
                {
                    RutaFoto = Foto.Path;
                    Imagen.Source = RutaFoto;
                    ObjLectura.Imagen = ConvertirImagen();//asigno a foto a la propiedad del objeto lectura
                    ObjLectura.StrImagen = RutaFoto;//asigno la ruta a la propiedad del objeto lectura
                }
            }
            catch (Exception ex)
            {
                string error = ex.Message;
                nErrores++;
            }
        }

        public Command m_tomarFotoComand;//cuando se requiere tomar una foto

        public async void TomarFotoAsync(object sender, EventArgs e)
        {
            int nErrores = 0;
            try
            {
                Foto = await ServicioFoto.Instancia.CapturarFotoAsync();
                if (Foto != null)
                {
                    RutaFoto = Foto.Path;
                    Imagen.Source = RutaFoto;
                    ObjLectura.Imagen = ConvertirImagen();//asigno a foto a la propiedad del objeto lectura
                    ObjLectura.StrImagen = RutaFoto;//asigno a foto a la propiedad del objeto lectura
                }
            }
            catch (Exception ex)
            {
                string error = ex.Message;
                nErrores++;
            }
            //return (nErrores == 0);
        }

        protected override async void OnAppearing()//se ejecuta cuando se muestra esta interfaz
        {
            base.OnAppearing();
            this.ObjUsuario = App.Current.Properties["ObjUsuario"] as ClsUsuario;//recuperar objeto guardado en propieades de la aplicación
            ObjLectura.User_id = ObjUsuario.Id;
            ButEliminar.IsVisible = false;
            try
            {
                manager = new CtrlLectura();//instancia de clase control
                if (opc)//cuando se está creando una lectura nueva
                {
                    this.ObjCtrlPersona = new CtrlPersona();
                    var ListPersona = await ObjCtrlPersona.ConsultarId(this.ObjMedidor.Persona_id);
                    if (ListPersona.Count() > 0)
                    {
                        this.ObjPersona = ListPersona.First();
                        LblNombres.Text = this.ObjPersona.Nombre + " " + this.ObjPersona.Apellido;
                        txtCedula.Text = this.ObjPersona.Cedula;
                    }

                    var LecturaAnterior = await manager.ConsultarAnterior(this.ObjMedidor.Id);
                    if (LecturaAnterior.Count == 1)
                    {
                        ClsLectura ObjLecAnterior = LecturaAnterior.First();
                        TxtAnterior.Text = ObjLecAnterior.Actual.ToString();
                        ObjLectura.Anterior = ObjLecAnterior.Actual;
                    }
                }
                else
                {
                    //cuando se está consultando una lectura
                    ButGuardar.IsVisible = false;
                    this.ObjCtrlPersona = new CtrlPersona();
                    CtrlMedidor ObjCtrlMedidor = new CtrlMedidor();
                    var ListMedidor = await ObjCtrlMedidor.Consultar(this.ObjLectura.Medidor_id);
                    if (ListMedidor.Count() == 1)
                    {
                        this.ObjMedidor = ListMedidor.First();
                        var ListPersona = await ObjCtrlPersona.ConsultarId(this.ObjMedidor.Persona_id);
                        if (ListPersona.Count() == 1)
                        {
                            this.ObjPersona = ListPersona.First();
                            LblNombres.Text = this.ObjPersona.Nombre + " " + this.ObjPersona.Apellido;
                            txtCedula.Text = this.ObjPersona.Cedula;
                            txtConsumo.Text = this.ObjLectura.Consumo.ToString();
                            TxtObservacion.Text = this.ObjLectura.Observacion;
                            TxtAnterior.Text = ObjLectura.Anterior.ToString();
                            ObjLectura.Anterior = ObjLectura.Actual;
                            lblCodigo.Text = ObjMedidor.Codigo.ToString();
                            lblNumero.Text = ObjMedidor.Numero.ToString();
                            if (ObjLectura.Image != null)
                                Imagen.Source = ObjLectura.Image;
                        }
                    }
                }
            }
           catch(Exception ex)
            {
                await DisplayAlert("Mensaje", ex.Message, "ok");
            }
                     
        }

        public PagIngresoLectura(ClsMedidor Obj, bool opc)//constructor para ingresar nuevo
        {
            InitializeComponent();
            this.opc = opc;//asignación de variable local
            this.ObjMedidor = Obj;//asignación de objeto local
            lblCodigo.Text = this.ObjMedidor.Codigo;
            lblNumero.Text = this.ObjMedidor.Numero;
            this.ObjLectura = new ClsLectura();
            this.ObjLectura.Created_at = DateTime.Now;//asigna fecha actual
            this.ObjLectura.Updated_at = DateTime.Now;
            this.ObjLectura.Fecha = DateTime.Today;//asignación de fecha actual
            this.ObjLectura.Medidor_id = this.ObjMedidor.Id;
            BindingContext = this.ObjLectura;//indica que la vista se relacionará con los valores del objeto
            this.ObjLectura.Localizar();
        }
        public PagIngresoLectura(ClsLectura Obj, bool opc)//constructor para consultar
        {
            InitializeComponent();
            this.opc = opc;//asignación de variable local
            this.ObjLectura = Obj;//asignación de objeto local
            BindingContext = this.ObjLectura;//indica que la vista se relacionará con los valores del objeto
            this.ObjLectura.Localizar();
        }

        public string ConvertirImagen()//transforma la imagen a Texto en base 64
        {
            byte[] ImageData = File.ReadAllBytes(RutaFoto);
            string base64String = Convert.ToBase64String(ImageData);
            return base64String;
        }
        //manejador del botón guardar
        private async void ButGuardar_Clicked(object sender, EventArgs e)
        {
            try
            {
                var res = "";
                if (ObjLectura.Observacion == null)
                    ObjLectura.Observacion = "s/n";
                if (ObjLectura.Image == null)
                    ObjLectura.StrImagen = "";
                if (opc)
                {
                    if (!string.IsNullOrWhiteSpace(LblNombres.Text) &&
                        !string.IsNullOrWhiteSpace(lblNumero.Text) &&
                        !string.IsNullOrWhiteSpace(txtConsumo.Text)//validación de no nulos
                        )
                    {
                        if (txtCedula.Text.Length == 10 &&
                        ObjLectura.Actual >= 0)//validación cedula con 10 caracteres
                        {
                                var ObjLecturaInsert = await manager.SaveAsync(ObjLectura);//llamada a método que inserta un nuevo registro
                                if (ObjLecturaInsert != null)
                                {
                                    res = ObjLecturaInsert;//respuesta positiva
                                }
                                else
                                    res = null;//respuesta negativa si no se realizó correctamente 
                        }
                        else
                        {
                            await DisplayAlert("Mensaje", "Faltan Datos Necesarios", "ok");
                            res = null;
                        }
                    }
                    else
                    {
                        await DisplayAlert("Mensaje", "Faltan Datos", "ok");
                        res = null;
                    }

                }
                else
                {
                    if (this.ObjLectura.Estado == "1")
                    {
                        await DisplayAlert("Mensaje", "No se puede modificar porque ya ha sido sincronizado en la base de datos remota", "ok");
                        res = null;
                    }
                    else
                    {
                        var ObjLecturaUpdate = await manager.UpdateAsync(ObjLectura);
                        if (ObjLecturaUpdate != null)
                        {
                            res = ObjLecturaUpdate;//respuesta positiva
                        }
                        else
                            res = null;//respuesta negativa si no se realizó correctamente 
                    }
                }
                if(res != null)
                {
                    await DisplayAlert("Mensaje", "Datos guardados correctamente", "ok");
                    ButGuardar.IsEnabled = false;
                }
            }
            catch (Exception ex)
            {
                await DisplayAlert("Mensaje", ex.Message, "ok");
            }
        }
       
        
        //manejados de caja de texto lectura actual
        private void txtLecturaActual_TextChanged(object sender, TextChangedEventArgs e)//se activa cuando cambia el texto de la caja
        {
            float.TryParse(txtLecturaActual.Text, out float FLecturaActual);//convertir en número decimal la información ingresada en el texto
            if(FLecturaActual > ObjLectura.Anterior)//si el valor ingresado es mayor a la lectura anterior
            {
                ObjLectura.Calcular();//lama al método calcular de la clase clslectura
                txtConsumo.Text = ObjLectura.Consumo.ToString();//mostrar variable consumo en caja de texto
            }
        }
        //manejador del botón eliminar
        private async void ButEliminar_ClickedAsync(object sender, EventArgs e)
        {
            if(!opc)
                try
                {
                    if (this.ObjLectura.Estado == "0")
                    {
                        var resp = await manager.DeleteAsync(ObjLectura);
                        await DisplayAlert("Mensaje", resp, "ok");
                    }
                    else
                        await DisplayAlert("Mensaje", "No se puede eliminar porque ya ha sido sincronizado con el servidor remoto", "ok");
                }
            catch(Exception ex)
                {
                    await DisplayAlert("Mensaje", ex.Message, "ok");
                }
        }

    }
}