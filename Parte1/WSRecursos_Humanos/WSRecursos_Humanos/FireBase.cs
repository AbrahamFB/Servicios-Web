using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

using FireSharp.Config;
using FireSharp.Interfaces;
using FireSharp.Response;
using System.Web.Script.Serialization;

namespace WSRecursos_Humanos
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
}