using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.Web;
using FireSharp.Interfaces;
using FireSharp.Config;

namespace psw.controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class getUsersController : ControllerBase
    {
        IFirebaseConfig config = new FirebaseConfig
        {
            AuthSecret = "1ZOAQRWIxCptsDSiUcRd8DIvBvGWhBr0LBYU5vLd",
            BasePath = "https://prueba-ff886-default-rtdb.firebaseio.com/",
        };
        IFirebaseClient client;

    }
}
