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



namespace WSRecursos_Humanos
{
    // NOTA: puede usar el comando "Rename" del menú "Refactorizar" para cambiar el nombre de interfaz "IService1" en el código y en el archivo de configuración a la vez.
    [ServiceContract]
    public interface IWSRecursos_Humanos
    {
        // TODO: agregue aquí sus operaciones de servicio
        [OperationContract]
        RespuestaSetUser setUser(string user, string pass, string newUser, string newPass);

        [OperationContract]
        RespuestaUpdateUser updateUser(string user, string pass, string oldUser, string newUser, string newPass);

        [OperationContract]
        RespuestaSetUserInfo setUserInfo(string user, string pass, string searchedUser, string userInfoJSON);

        [OperationContract] 
        RespuestaUpdateUserInfo updateUserInfo(string user, string pass, string searchedUser, string userInfoJSON);

        [OperationContract]
        RespuestaGetUsers getUsers();
    }
    [DataContract]
    public class Respuesta
    {
        public Respuesta()
        {
            Code = "999";
            Message = "Error no identificado";
            Data = "";
            Status = "error";
        }
       
        [DataMember]
        public string Code {
            get; set;
        }
        [DataMember]
        public string Message
        {
            get; set;
        }
        [DataMember]
        public string Data
        {
            get;
            set;
        }
        [DataMember]
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

    [DataContract]
    public class RespuestaSetUser : Respuesta
    {

    }
    [DataContract]
    public class RespuestaSetUserInfo : Respuesta
    {

    }

    [DataContract]
    public class RespuestaUpdateUser : Respuesta
    {

    }
    [DataContract]
    public class RespuestaUpdateUserInfo : Respuesta
    {

    }


    [DataContract]
    public class RespuestaGetUsers : Respuesta
    {

    }
    // Utilice un contrato de datos, como se ilustra en el ejemplo siguiente, para agregar tipos compuestos a las operaciones de servicio.
    //[DataContract]
    //public class CompositeType
    //{
    //    bool boolValue = true;
    //    string stringValue = "Hello ";

    //    [DataMember]
    //    public bool BoolValue
    //    {
    //        get { return boolValue; }
    //        set { boolValue = value; }
    //    }

    //    [DataMember]
    //    public string StringValue
    //    {
    //        get { return stringValue; }
    //        set { stringValue = value; }
    //    }
    //}
}
