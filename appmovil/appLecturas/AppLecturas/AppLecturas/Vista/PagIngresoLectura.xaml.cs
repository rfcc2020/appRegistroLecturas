using AppLecturas.Controlador;
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

        private MediaFile Foto;

        public Command m_seleccionarFotoComand;

        public async void SeleccionarFotoAsync(object sender, EventArgs e)
        {
            int nErrores = 0;
            try
            {
                Foto = await ServicioFoto.Instancia.SeleccionarFotoAsync();
                if (Foto != null)
                {
                    RutaFoto = Foto.Path;
                    Imagen.Source = RutaFoto;
                }
            }
            catch (Exception ex)
            {
                string error = ex.Message;
                nErrores++;
            }
        }

        public Command m_tomarFotoComand;

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
                }
            }
            catch (Exception ex)
            {
                string error = ex.Message;
                nErrores++;
            }
            //return (nErrores == 0);
        }

        protected override async void OnAppearing()
        {
            base.OnAppearing();
            this.ObjCtrlPersona = new CtrlPersona();
            var ListPersona = await ObjCtrlPersona.ConsultarId(this.ObjMedidor.Persona_id);
            if (ListPersona.Count() > 0)
            {
                this.ObjPersona = ListPersona.First();
                LblNombres.Text = this.ObjPersona.Nombre + " " + this.ObjPersona.Apellido;
                txtCedula.Text = this.ObjPersona.Cedula;
            }
        }

        public PagIngresoLectura(ClsMedidor Obj, bool opc)//constructor
        {
            InitializeComponent();
            this.opc = opc;//asignación de variable local
            this.ObjMedidor = Obj;//asignación de objeto local
            lblCodigo.Text = this.ObjMedidor.Codigo;
            lblNumero.Text = this.ObjMedidor.Numero;
            this.ObjLectura = new ClsLectura();
            this.ObjLectura.Created_at = DateTime.Now;//asigna fecha actual
            this.ObjLectura.Updated_at = DateTime.Now;
            ObjLectura.Fecha = DateTime.Today;//asignación de fecha actual
            manager = new CtrlLectura();//instancia de clase control
            BindingContext = this.ObjLectura;//indica que la vista se relacionará con los valores del objeto
            this.ObjLectura.Localizar();
        }

        public string ConvertirImagen()
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
                if (opc)
                {
                    if (!string.IsNullOrWhiteSpace(LblNombres.Text) &&
                        !string.IsNullOrWhiteSpace(lblNumero.Text) &&
                        !string.IsNullOrWhiteSpace(txtConsumo.Text)//validación de no nulos
                        )
                    {
                        if (txtCedula.Text.Length == 10 &&
                        ObjLectura.Actual > 0)//validación cedula con 10 caracteres
                        {
                                ObjLectura.Imagen = ConvertirImagen();
                                var ObjLecturaInsert = await manager.SaveAsync(ObjLectura);//llamada a método que inserta un nuevo registro
                                if (ObjLecturaInsert != null)
                                {
                                    //Obj = ObjLecturaInsert.First();//asignación de objeto local con datos recién ingresados
                                    //txtId.Text = Obj.Id.ToString();//mostrar id del registro creado
                                    res = ObjLecturaInsert;//respuesta positiva
                                }
                                else
                                    res = null;//respuesta negativa si no se realizó correctamente 
                        }
                        else
                        {
                            await DisplayAlert("Mensaje", "Faltan Datos Necesarios", "ok");
                        }
                    }
                    else
                        await DisplayAlert("Mensaje", "Faltan Datos", "ok");
                }else
                {
                    var ObjLecturaUpdate = await manager.UpdateAsync(ObjLectura);
                    if (ObjLecturaUpdate != null)
                    {
                        //Obj = ObjLecturaInsert.First();//asignación de objeto local con datos recién ingresados
                        //txtId.Text = Obj.Id.ToString();//mostrar id del registro creado
                        res = ObjLecturaUpdate;//respuesta positiva
                    }
                    else
                        res = null;//respuesta negativa si no se realizó correctamente 
                }
                if(res != null)
                    await DisplayAlert("Mensaje", "Datos guardados correctamente", "ok");
            }
            catch (Exception e1)
            {
                await DisplayAlert("Mensaje", e1.Message, "ok");
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

        private async void ButEliminar_ClickedAsync(object sender, EventArgs e)
        {
            var resp = await manager.DeleteAsync(ObjLectura);
            await DisplayAlert("Mensaje", resp, "ok");
        }
        
    }
}