using Microsoft.Extensions.Configuration;
using Microsoft.IdentityModel.JsonWebTokens;
using Microsoft.IdentityModel.Tokens;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.Claims;
using System.Text;
using System.Threading.Tasks;
using System.IdentityModel.Tokens.Jwt;
using System.IdentityModel.Tokens;


namespace psw
{
    public class TokenService
    {
        private readonly SymmetricSecurityKey _ssKey;

        public TokenService(IConfiguration config)
        {
            _ssKey = new SymmetricSecurityKey(Encoding.ASCII.GetBytes(config["Token"]));
        }

        public string CreateToken(LoginRequet user)
        {
            var tokenHandler = new JwtSecurityTokenHandler();
            var tokenDescriptor = new SecurityTokenDescriptor
            {
                Subject = new ClaimsIdentity(new Claim[]
                {
                    new Claim(ClaimTypes.Name, user.name),
                    new Claim(ClaimTypes.NameIdentifier, user.password)

                }),
                Expires = DateTime.UtcNow.AddHours(1),
                SigningCredentials = new SigningCredentials(_ssKey, SecurityAlgorithms.HmacSha256Signature)
            };

            var token = tokenHandler.CreateToken(tokenDescriptor);

            return tokenHandler.WriteToken(token);
        }

    }
}
