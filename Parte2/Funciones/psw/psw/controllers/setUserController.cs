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
using Newtonsoft.Json;
using FireSharp.Response;
using System.Text.RegularExpressions;

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

                        var usuarios = client.get2("usuarios_info/");
                        //var respuesta = JsonConvert.DeserializeObject<Dictionary<string, dynamic>>(usuarios.);

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
        [HttpPost("set/user")]
        public ActionResult setUser([FromHeader] string Authorization, [FromBody] LoginRequet usuario)
        {
            FireBase client = new FireBase();

            LoginRequet u = _tokenService.ReadToken(Authorization);
            var user = u.name;
            var pass = u.password;
            var respuesta = new Respuesta();
            var contr = client.get("usuarios/" + user);
            if (contr != null)
            {

                var permiso = client.get("usuarios_info/" + user);

                if (Encrypt.GetMD5(pass) == contr)
                {

                    if (permiso["rol"] == "rh")
                    {
                        var newUserExists = client.get("usuarios/" + usuario.name);
                        if (newUserExists == null)
                        {

                            string passEncrypt = Encrypt.GetMD5(usuario.password);
                            SetResponse response = client.Cliente.Set("usuarios/" + usuario.name, passEncrypt);
                            if (response != null)
                            {
                                var resp205 = client.get("respuesta/" + 206);

                                respuesta.updateRespuesta("206", resp205, "success");
                            }

                        }
                        else
                        {
                            var resp306 = client.get("respuesta/" + 306);
                            respuesta.updateRespuesta("306", resp306);
                        }

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

        [HttpPost("update/user")]
        public ActionResult updateUser([FromHeader] string Authorization, [FromBody] UpdateUser usuario)
        {
            FireBase client = new FireBase();

            LoginRequet u = _tokenService.ReadToken(Authorization);
            var user = u.name;
            var pass = u.password;
            var respuesta = new Respuesta();
            var contr = client.get("usuarios/" + user);
            if (contr != null)
            {

                var permiso = client.get("usuarios_info/" + user);

                if (Encrypt.GetMD5(pass) == contr)
                {

                    if (permiso["rol"] == "rh")
                    {

                        var newUserExists = client.get("usuarios/" + usuario.oldUser);
                        if (newUserExists != null)
                        {
                            if (usuario.newUser.Any(char.IsDigit) && !usuario.newUser.Any(char.IsWhiteSpace) && usuario.newUser.Any(char.IsLetter))
                            {

                                if (usuario.newPass.Length >= 8 && usuario.newPass.Any(char.IsDigit))
                                {
                                    string passEncrypt = Encrypt.GetMD5(usuario.newPass);
                                    SetResponse response = client.Cliente.Set("usuarios/" + usuario.newUser, passEncrypt);
                                    if (response != null)
                                    {
                                        var resp = client.get("respuesta/" + 207);
                                        respuesta.updateRespuesta(
                                            "207",
                                            resp,
                                            "successs"
                                       );
                                        client.Cliente.Delete("usuarios/" + usuario.oldUser);
                                    }
                                }
                                else
                                {
                                    var resp307 = client.get("respuesta/" + 309);
                                    respuesta.updateRespuesta("309", resp307);
                                }

                            }
                            else
                            {
                                var resp307 = client.get("respuesta/" + 308);
                                respuesta.updateRespuesta("308", resp307);
                            }
                        }

                        else
                        {
                            var resp307 = client.get("respuesta/" + 307);
                            respuesta.updateRespuesta("307", resp307);
                        }
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

        [HttpPost("set/user_info")]
        public ActionResult setUserInfo([FromHeader] string Authorization, [FromBody] userInfo usuario)
        {
            FireBase client = new FireBase();

            LoginRequet u = _tokenService.ReadToken(Authorization);
            var user = u.name;
            var pass = u.password;
            var respuesta = new Respuesta();
            var contr = client.get("usuarios/" + user);
            if (contr != null)
            {

                var permiso = client.get("usuarios_info/" + user);

                if (Encrypt.GetMD5(pass) == contr)
                {

                    if (permiso["rol"] == "rh")
                    {
                        var userExist = client.get("usuarios_info/" + usuario.searchedUser);
                        if (userExist == null)
                        {
                            JSONValidator schema = new JSONValidator();
                            if(schema.IsJsonValid( JsonConvert.SerializeObject(usuario.userInfoJSON )))
                            {
                                UserInfoJSON us = usuario.userInfoJSON;
                                if (us.correo != null && us.nombre != null && us.rol != null && us.telefono.ToString() != null)
                                {
                                    SetResponse response = client.Cliente.Set("usuarios_info/" + usuario.searchedUser, usuario.userInfoJSON);
                                    if (response != null)
                                    {
                                        var resp = client.get("respuesta/" + 208);
                                        respuesta.updateRespuesta(
                                            "208",
                                            resp,
                                            "success"
                                        );
                                    }
                                }
                                else
                                {
                                    var resp = client.get("respuesta/" + 312);
                                    respuesta.updateRespuesta("312", resp);
                                }
                            }
                            else
                            {
                                var resp = client.get("respuesta/" + 311);
                                respuesta.updateRespuesta("311", resp);
                            }
                        }
                        else
                        {
                            var resp = client.get("respuesta/" + 310);
                            respuesta.updateRespuesta("310", resp);
                        }

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
        [HttpPost("update/user_info")]
        public ActionResult updateUserInfo([FromHeader] string Authorization, [FromBody] userInfo usuario)
        {
            FireBase client = new FireBase();

            LoginRequet u = _tokenService.ReadToken(Authorization);
            var user = u.name;
            var pass = u.password;
            var respuesta = new Respuesta();
            var contr = client.get("usuarios/" + user);
            if (contr != null)
            {

                var permiso = client.get("usuarios_info/" + user);

                if (Encrypt.GetMD5(pass) == contr)
                {

                    if (permiso["rol"] == "rh")
                    {
                        var userExist = client.get("usuarios_info/" + usuario.searchedUser);
                        if (userExist != null)
                        {
                            JSONValidator schema = new JSONValidator();
                            if (schema.IsJsonValid(JsonConvert.SerializeObject(usuario.userInfoJSON)))
                            {
                                UserInfoJSON us = usuario.userInfoJSON;
                                if (us.correo != null && us.nombre != null && us.rol != null && us.telefono.ToString() != null)
                                {
                                    SetResponse response = client.Cliente.Set("usuarios_info/" + usuario.searchedUser, usuario.userInfoJSON);
                                    if (response != null)
                                    {
                                        var resp = client.get("respuesta/" + 209);
                                        respuesta.updateRespuesta(
                                            "209",
                                            resp,
                                            "success"
                                        );
                                    }
                                }
                                else
                                {
                                    var resp = client.get("respuesta/" + 312);
                                    respuesta.updateRespuesta("312", resp);
                                }
                            }
                            else
                            {
                                var resp = client.get("respuesta/" + 311);
                                respuesta.updateRespuesta("311", resp);
                            }
                        }
                        else
                        {
                            var resp = client.get("respuesta/" + 313);
                            respuesta.updateRespuesta("313", resp);
                        }

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

