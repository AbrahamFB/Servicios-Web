using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using System;
using System.Collections.Generic;
using System.IdentityModel.Tokens.Jwt;
using System.Linq;
using System.Threading.Tasks;
using System.Security.Cryptography;
using System.Text;
using System.Collections;

namespace psw.controllers
{
    [Authorize]
    [Route("api/[controller]")]
    [ApiController]
    public class setUserController : ControllerBase
    {
        private readonly TokenService _tokenService;
        public setUserController(TokenService token)
        {
            _tokenService = token;
        }
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
        [HttpGet("get/user")]
        public ActionResult getUsers([FromHeader] string Authorization)
        {
            FireBase client = new FireBase();

            var token = Authorization.StartsWith("Bearer ") ? Authorization.Substring(7) : Authorization;
            var stream = token;
            var handler = new JwtSecurityTokenHandler();
            var jsonToken = handler.ReadToken(stream);
            var tokenS = jsonToken as JwtSecurityToken;

            var user = tokenS.Claims.First(claim => claim.Type == "unique_name").Value;
            var pass = tokenS.Claims.First(claim => claim.Type == "nameid").Value;

            

            var datos = user + " " +pass;
            var respuesta = new Respuesta();
            var contr = client.get("usuarios/" + user);
                if (contr != null)
            {

                var permiso = client.get("usuarios_info/" + user);
         
                if (Encrypt.GetMD5(pass) == contr)
                {

                    if (permiso["rol"] == "rh")
                    {
                        ArrayList lista = new ArrayList();
                        var usuarios = client.get1("usuarios/");
                        var resp205 = client.get("respuesta/" + 205);

                        respuesta.updateRespuesta("205", resp205, "success", usuarios.Keys);                       
                    }
                    else
                    {
                        var resp305 = client.get("respuesta/" + 305);
                        respuesta.updateRespuesta("305", resp305);
                    }
                    
                }
                else
                {
                    return Unauthorized();
                }
            }
            else
            {
                return Unauthorized();
            }


            return Ok(respuesta);
        }


        [HttpGet("get/userInfo")]
        public ActionResult getUserInfo([FromHeader] string Authorization)
        {
            FireBase client = new FireBase();

            var token = Authorization.StartsWith("Bearer ") ? Authorization.Substring(7) : Authorization;
            var stream = token;
            var handler = new JwtSecurityTokenHandler();
            var jsonToken = handler.ReadToken(stream);
            var tokenS = jsonToken as JwtSecurityToken;

            var user = tokenS.Claims.First(claim => claim.Type == "unique_name").Value;
            var pass = tokenS.Claims.First(claim => claim.Type == "nameid").Value;



            var datos = user + " " + pass;
            var respuesta = new Respuesta();
            var contr = client.get("usuarios/" + user);
            if (contr != null)
            {

                var permiso = client.get("usuarios_info/" + user);

                if (Encrypt.GetMD5(pass) == contr)
                {

                    if (permiso["rol"] == "rh")
                    {
                        ArrayList lista = new ArrayList();

                        var usuarios = client.get1("usuarios_info/");
                        
                        
                        var resp205 = client.get("respuesta/" + 205);

                        respuesta.updateRespuesta("205", resp205, "success", usuarios);
                    }
                    else
                    {
                        var resp305 = client.get("respuesta/" + 305);
                        respuesta.updateRespuesta("305", resp305);
                    }

                }
                else
                {
                    return Unauthorized();
                }
            }
            else
            {
                return Unauthorized();
            }


            return Ok(respuesta);

        }

        public class Encrypt
        {
            public static string GetMD5(string str)
            {
                MD5 md5 = MD5CryptoServiceProvider.Create();
                ASCIIEncoding encoding = new ASCIIEncoding();
                byte[] stream = null;
                StringBuilder sb = new StringBuilder();
                stream = md5.ComputeHash(encoding.GetBytes(str));
                for (int i = 0; i < stream.Length; i++) sb.AppendFormat("{0:x2}", stream[i]);
                return sb.ToString();
            }
        }
        [AllowAnonymous]
        [HttpPost("login")]
        public ActionResult Post([FromBody]LoginRequet user)
        {
            var token = _tokenService.CreateToken(user);
            return Ok(new
            {
                token = token
            }) ;

        }
    }
 

}

