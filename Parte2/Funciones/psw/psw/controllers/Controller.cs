using Microsoft.AspNetCore.Mvc;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace psw.controllers
{
    public class Controller : Controller
    {
        public IActionResult Index()
        {
            return View();
        }
    }
}
