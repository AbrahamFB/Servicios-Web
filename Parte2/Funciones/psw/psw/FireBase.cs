using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

using FireSharp.Config;
using FireSharp.Interfaces;
using FireSharp.Response;
using System.Web.Script.Serialization;

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
        dynamic respuesta = js.Deserialize<dynamic>(res.Body);
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
        public string Data
        {
            get;
            set;
        }
        public string Status
        {
            get; set;
        }
        public void updateRespuesta(string code, string message, string status = "error", string data = "")
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
}