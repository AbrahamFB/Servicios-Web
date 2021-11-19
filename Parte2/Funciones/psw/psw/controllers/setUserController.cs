using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace psw.controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class setUserController : ControllerBase
    {
        [HttpGet("{id}")]
        public string Get(int id)
        {
            return id switch
            {
                1 => "ivan",
                2 => "curso",
                _ => throw new NotSupportedException("el id no es válido"),
            };
        }

        [HttpPost("ruta")]
        public string Post(Usuario datos)
        {
            return datos.nombre;
        }
    }
    public class Usuario
    {
        public string nombre { get; set; }
        public string contrasena { get; set; }

    }

}

