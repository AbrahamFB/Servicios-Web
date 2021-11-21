using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

using FireSharp.Config;
using FireSharp.Interfaces;
using FireSharp.Response;
using System.Web.Script.Serialization;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;

namespace psw
{ 
    public class FireBase
{
    IFirebaseClient client;
    public FireBase()
    {
        IFirebaseConfig config = new FirebaseConfig
        {
            AuthSecret = "1ZOAQRWIxCptsDSiUcRd8DIvBvGWhBr0LBYU5vLd",
            BasePath = "https://prueba-ff886-default-rtdb.firebaseio.com/"
        };
        client = new FireSharp.FirebaseClient(config);
    }
    public IFirebaseClient Cliente
    {
        get { return client; }
        set { client = value; }
    }
    public dynamic get(string coleccion)
    {
        FirebaseResponse res = client.Get(coleccion);
        JavaScriptSerializer js = new JavaScriptSerializer();
        var respuesta = JsonConvert.DeserializeObject<dynamic>(res.Body);
        //dynamic respuesta = js.Deserialize<dynamic>(res.Body);
        return respuesta;
    }
    public Dictionary<string, dynamic> get1(string coleccion)
    {
        FirebaseResponse res = client.Get(coleccion);
            var respuesta = JsonConvert.DeserializeObject<Dictionary<string, dynamic>>(res.Body);
            
        return respuesta;
    }

    public List<userInfo> obtenerInfoUser(string coleccion)
    {
        FirebaseResponse res = client.Get(coleccion);
        JavaScriptSerializer js = new JavaScriptSerializer();

        var respuesta = JsonConvert.DeserializeObject<List<userInfo>>(res.Body);
        return respuesta;
  }

    }
    public class Respuesta
    {
        public Respuesta()
        {
            Code = "999";
            Message = "Error no identificado";
            Data = "";
            Status = "error";
        }
        public string Code
        {
            get; set;
        }
        public string Message
        {
            get; set;
        }
        public Object Data
        {
            get;
            set;
        }
        public string Status
        {
            get; set;
        }
        public void updateRespuesta(string code, string message, string status = "error", Object data = null)
        {
            Message = message;
            Code = code;
            Status = status;
            Data = data;
        }

        public void getRespuesta(string code, string message, string status = "error", string data = "")
        {
            Message = message;
            Code = code;
            Status = status;
            Data = data;
        }
    }
    public class LoginRequet
    {
        public string name { get; set; }
        public string password { get; set; }
    }

    public class userInfo
    {
        public string nombre { get; set; }
        public string rol { get; set; }
        public string correo { get; set; }
        public long telefono { get; set; }
    }
}