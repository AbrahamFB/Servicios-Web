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


        public RespuestaSetUser setUser(string user, string pass, string newUser, string newPass)
        {
            FireBase client = new FireBase();
            var respuestas = client.get("respuesta");

            RespuestaSetUser res = res = new RespuestaSetUser();
 
            var passUsuario = client.get("usuarios/" + user);
            
            if (passUsuario != null)
            {
                if( passUsuario == Encrypt.GetMD5(pass) )
                {
                    var permiso = client.get("usuarios_info/"+user);
                    if( permiso["rol"] == "rh")
                    {
                        if( newUser!= "" && newUser != "?" && newPass != "")
                        {
                            var newUserExists = client.get("usuarios/" + newUser);
                            if (newUserExists == null)
                            {
                                string passEncrypt = Encrypt.GetMD5(newPass);
                                SetResponse response = client.Cliente.Set( "usuarios/"+newUser ,passEncrypt);
                                if ( response != null)
                                {
                                    var date = DateTime.UtcNow;
                                    res.updateRespuesta(
                                                        "404", 
                                                        respuestas["404"], 
                                                        "success",
                                                        date.ToString("yyyy-MM-ddTHH:mm:ss")
                                                        );
                                }
                            }
                            else
                            {
                                res.updateRespuesta( "508", respuestas["508"] );
                            }
                        }
                        else
                        {
                            res.updateRespuesta("506", "El usuario o password están vacios");
                        }
                        
                    }
                    else
                    {
                      res.updateRespuesta( "504", respuestas["504"] );
                    }
                }
                else
                {
                    res.updateRespuesta( "501", respuestas["501"] );
                }
            }
            else
            { 
                res.updateRespuesta( "500", respuestas["500"] );
            }          
            
            return res;
        }
        public RespuestaUpdateUser updateUser(string user, string pass, string oldUser, string newUser, string newPass)
        {
            FireBase client = new FireBase();
            var respuestas = client.get("respuesta");

            RespuestaUpdateUser res = res = new RespuestaUpdateUser();

            var passUsuario = client.get("usuarios/" + user);

            if (passUsuario != null)
            {
                if (passUsuario == Encrypt.GetMD5(pass))
                {
                    var permiso = client.get("usuarios_info/" + user);
                    if (permiso["rol"] == "rh")
                    {
                        if (newUser != "" && newUser != "?" && newPass != "")
                        {
                            var newUserExists = client.get("usuarios/" + oldUser);
                            if (newUserExists != null)
                            {
                                Regex r = new Regex("^[a-zA-Z0-9]*$");
                                if (r.IsMatch(newUser))
                                {
                                    r = new Regex(@"\d+");
                                    if ( newPass.Length >= 8 && r.IsMatch(newPass) )
                                    {
                                        string passEncrypt = Encrypt.GetMD5(newPass);
                                        SetResponse response = client.Cliente.Set("usuarios/" + newUser, passEncrypt);
                                        if (response != null)
                                        {
                                            var date = DateTime.UtcNow;
                                            res.updateRespuesta(
                                                "401", 
                                                respuestas["401"], 
                                                "successs", 
                                                date.ToString("yyyy-MM-ddTHH:mm:ss")
                                           );
                                            client.Cliente.Delete("usuarios/" + oldUser);
                                        }
                                    }
                                    else
                                    {
                                        res.updateRespuesta("502", respuestas["502"]);
                                    }
                                }
                                else
                                {
                                    res.updateRespuesta("503", respuestas["503"]);
                                }
                            }
                            else
                            {
                                res.updateRespuesta("505", respuestas["505"]);
                            }
                        }
                        else
                        {
                            res.updateRespuesta("506", "El usuario o password están vacios");
                        }

                    }
                    else
                    {
                        res.updateRespuesta("504", respuestas["504"]);
                    }
                }
                else
                {
                    res.updateRespuesta("501", respuestas["501"]);
                }
            }
            else
            {
                res.updateRespuesta("500", respuestas["500"]);
            }

            return res;
        }

        public RespuestaSetUserInfo setUserInfo(string user, string pass, string searchedUser, string userInfoJSON)
        {
            FireBase client = new FireBase();
            RespuestaSetUserInfo res = new RespuestaSetUserInfo();
            var respuestas = client.get("respuesta");

            var passUsuario = client.get("usuarios/" + user);       
            if (passUsuario != null)
            {
                if (passUsuario == Encrypt.GetMD5(pass))
                {
                    var permiso = client.get("usuarios_info/" + user);
                    if (permiso["rol"] == "rh")
                    {
                        var userExist = client.get("usuarios_info/" + searchedUser);
                        if( userExist == null)
                        {
                            JObject user_info = JObject.Parse(userInfoJSON);
                            JSONValidator schema = new JSONValidator();
                            if ( user_info.IsValid(schema.Schema) )
                            {

                                JObject data = JObject.Parse(userInfoJSON);
                                
                                if ( schema.isComplete(4, data))
                                {
                                    dynamic userinfo = JsonConvert.DeserializeObject(userInfoJSON);
                                    SetResponse response = client.Cliente.Set("usuarios_info/" + searchedUser, userinfo);
                                    if (response != null)
                                    {
                                        var date = DateTime.UtcNow;
                                        res.updateRespuesta(
                                            "402", 
                                            respuestas["402"], 
                                            "success", 
                                            date.ToString("yyyy-MM-ddTHH:mm:ss")
                                        );
                                    }
                                }
                                else
                                {
                                    res.updateRespuesta("304", respuestas["304"]);
                                }
                            }
                            else
                            {
                                res.updateRespuesta("305", respuestas["305"]);
                            }
                        }
                        else{ 
                            res.updateRespuesta( "506", respuestas["506"] );
                        }

                    }
                    else
                    {
                        res.updateRespuesta("504", respuestas["504"]);
                    }
                }
                else
                {
                    res.updateRespuesta("501", respuestas["501"]);
                }
            }
            else
            {
                res.updateRespuesta("500", respuestas["500"]);
            }

            return res;
        }

        public RespuestaUpdateUserInfo updateUserInfo(string user, string pass, string searchedUser, string userInfoJSON)
        {
            FireBase client = new FireBase();
            RespuestaUpdateUserInfo res = new RespuestaUpdateUserInfo();
            var respuestas = client.get("respuesta");

            var passUsuario = client.get("usuarios/" + user);
            if (passUsuario != null)
            {
                if (passUsuario == Encrypt.GetMD5(pass))
                {
                    var permiso = client.get("usuarios_info/" + user);
                    if (permiso["rol"] == "rh")
                    {
                        var userExist = client.get("usuarios_info/" + searchedUser);
                        if (userExist != null)
                        {
                            JObject user_info = JObject.Parse(userInfoJSON);
                            JSONValidator schema = new JSONValidator();
                            if (user_info.IsValid(schema.Schema))
                            {

                                JObject data = JObject.Parse(userInfoJSON);

                                if (schema.isComplete(4, data))
                                {
                                    dynamic userinfo = JsonConvert.DeserializeObject(userInfoJSON);
                                    FirebaseResponse response = client.Cliente.Update("usuarios_info/" + searchedUser, userinfo);
                                    if (response != null)
                                    {
                                        TimeZoneInfo utc = TimeZoneInfo.FindSystemTimeZoneById("Central Standard Time");
                                        var date = TimeZoneInfo.ConvertTimeFromUtc(DateTime.UtcNow, utc);
                                        
                                        res.updateRespuesta(
                                            "403",
                                            respuestas["403"],
                                            "success",
                                            date.ToString("yyyy-MM-dd-THH:mm:ss")
                                        );
                                    }
                                }
                                else
                                {
                                    res.updateRespuesta("304", respuestas["304"]);
                                }
                            }
                            else
                            {
                                res.updateRespuesta("305", respuestas["305"]);
                            }
                        }
                        else
                        {
                            res.updateRespuesta("507", respuestas["507"]);
                        }

                    }
                    else
                    {
                        res.updateRespuesta("504", respuestas["504"]);
                    }
                }
                else
                {
                    res.updateRespuesta("501", respuestas["501"]);
                }
            }
            else
            {
                res.updateRespuesta("500", respuestas["500"]);
            }
            return res;
        }

        public RespuestaGetUsers getUsers()
        {
            FireBase client = new FireBase();
            RespuestaGetUsers res = new RespuestaGetUsers();
            var respuestas = client.get("respuesta");


            //SetResponse response = client.Cliente.Get("/usuarios", );

            var usuarios = client.get("usuarios");

            res.getRespuesta(
                                           "403",
                                           respuestas["403"],
                                           "success",
                                           usuarios
                                       );
            return res;
        }

    }

 
}
