using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;
using FireSharp.Config;
using FireSharp.Interfaces;
using FireSharp.Response;
using System.Web.Script.Serialization;

using System.Text.RegularExpressions;

using Newtonsoft.Json.Schema;
using Newtonsoft.Json.Linq;
using Newtonsoft.Json;
namespace WSRecursos_Humanos
{
    // NOTA: puede usar el comando "Rename" del menú "Refactorizar" para cambiar el nombre de clase "Service1" en el código, en svc y en el archivo de configuración.
    // NOTE: para iniciar el Cliente de prueba WCF para probar este servicio, seleccione Service1.svc o Service1.svc.cs en el Explorador de soluciones e inicie la depuración.
    public class WSRecursos_Humanos : IWSRecursos_Humanos
    {

        public RespuestaSetProd setProd(string user, string pass, string categoria, string producto)
        {
            RespuestaSetProd res = new RespuestaSetProd();
            FireBase client = new FireBase();

            var passUsuario = client.get("usuarios/" + user);
            if (passUsuario != null)
            {
                if (passUsuario == Encrypt.GetMD5(pass))
                {

                    if (this.IsJsonValid(producto))
                    {

                        dynamic product = (JObject)JsonConvert.DeserializeObject(producto);
                        JavaScriptSerializer js = new JavaScriptSerializer();
                        dynamic objeto = js.Deserialize<dynamic>(producto);
                        IEnumerable<dynamic> data = product.Descendants();
                        string isbn = data.ToArray()[9];
                        string nombre = data.ToArray()[11];

                        var detalle = client.get("detalles/" + isbn);
                        if (detalle == null)
                        {
                            SetResponse response = client.Cliente.Set("detalles/" + isbn, product[isbn]);
                            SetResponse response2 = client.Cliente.Set("productos/" + categoria + "/" + isbn, nombre);
                            if (response != null)
                            {
                                var date = DateTime.UtcNow;
                                res.updateRespuesta(
                                    "202",
                                    client.get("respuesta/202"),
                                    "success",
                                    date.ToString("yyyy-MM-ddTHH:mm:ss")
                                );
                            }
                        }
                        else
                        {
                            res.updateRespuesta("302", client.get("respuesta/302"));
                        }
                    }
                    else
                    {
                        res.updateRespuesta("303", client.get("respuesta/303"));
                    }
                }
                else
                {
                    res.updateRespuesta("501", client.get("respuesta/501"));
                }
            }
            else
            {
                res.updateRespuesta("500", client.get("respuesta/500"));
            }

            return res;
        }

        public RespuestaUpdateProd updateProd(string user, string pass, string isbn, string detalles)
        {
            RespuestaUpdateProd res = new RespuestaUpdateProd();
            FireBase client = new FireBase();

            var passUsuario = client.get("usuarios/" + user);
            if (passUsuario != null)
            {
                if ( passUsuario == Encrypt.GetMD5( pass ) )
                {
                   
                    if (this.IsJsonValid(detalles))
                    {

                        dynamic product = (JObject)JsonConvert.DeserializeObject(detalles);
                        JavaScriptSerializer js = new JavaScriptSerializer();
                                         
                        var detalle = client.get("detalles/" + isbn); 
                        if( detalle != null)
                        {
                            FirebaseResponse response = client.Cliente.Update("detalles/"+ isbn, product);
                            
                            if (response != null)
                            {
                                var date = DateTime.UtcNow;
                                res.updateRespuesta(
                                    "203",
                                    client.get("respuesta/203"),
                                    "success",
                                    date.ToString("yyyy-MM-ddTHH:mm:ss")
                                );
                            }
                        }
                        else
                        {
                            res.updateRespuesta("304", client.get("respuesta/304"));
                        }
                    }
                    else
                    {
                        res.updateRespuesta("303", client.get("respuesta/303"));
                    }
                }
                else
                {
                    res.updateRespuesta("501", client.get("respuesta/501"));
                }
            }
            else
            {
                res.updateRespuesta("500", client.get("respuesta/500"));
            }

                return res;
        }
       

        public RespuestaDeleteProd deleteProd(string user, string pass, string isbn)
        {
            RespuestaDeleteProd res = new RespuestaDeleteProd();
            FireBase client = new FireBase();

            var passUsuario = client.get("usuarios/" + user);
            if (passUsuario != null)
            {
                if (passUsuario == Encrypt.GetMD5(pass))
                {
                    var detalle = client.get("detalles/" + isbn);
                    if (detalle != null)
                    {
                        FirebaseResponse response = client.Cliente.Delete("detalles/" + isbn);
                        string categoria = this.getCategoria(isbn);
                        FirebaseResponse response2 = client.Cliente.Delete("productos/" + categoria + "/"+ isbn);

                        if (response != null)
                        {
                            var date = DateTime.UtcNow;
                            res.updateRespuesta(
                                "204",
                                client.get("respuesta/204"),
                                "success",
                                date.ToString("yyyy-MM-ddTHH:mm:ss")
                            );
                        }

                    }
                    else
                    {
                        res.updateRespuesta("304", client.get("respuesta/304"));
                    }
                }
                else
                {
                    res.updateRespuesta("501", client.get("respuesta/501"));
                }
            }
            else
            {
                res.updateRespuesta("500", client.get("respuesta/500"));
            }

            return res;
        }
        public  bool IsJsonValid(string JSON)
        {
            try { return JObject.Parse(JSON) != null; } catch { }

            return false;
        }
        public string getCategoria( string isbn)
        {
            string categoria = "";

            char[] ISBN = isbn.ToArray();
            if (ISBN[0] == 'M')
                categoria = "mangas";

            if (ISBN[0] == 'L')
                categoria = "libros";

            if (ISBN[0] == 'C')
                categoria = "comics";
            return categoria;
        }

    }

 
}
