using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

using System.Text.RegularExpressions;
using Newtonsoft.Json.Linq;

using Newtonsoft.Json.Schema;

namespace psw
{
    public class JSONValidator
    {
        public JSONValidator()
        {
            string schemaJSONUser = @"
            {
	            '$schema': 'https://json-schema.org/draft/2019-09/schema',
                'description': 'Info User',
                'type' : 'object',
                'properties':
                            {
                                'correo': 
                                        {
                                            'type': 'string',
                                            'format': 'email'
                                        },
                                'nombre': { 'type': 'string' },
                                'rol': { 'type': 'string'},
                                'telefono': 
                                        {
                                            'type': 'string',
                                            'pattern': '^[0-9]{2,3}-?[0-9]{1,2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}$'
                                        }
            }
        }";
            Schema = JsonSchema.Parse(schemaJSONUser);
        }
        public JsonSchema Schema { get; set; }
        public bool isComplete(int Length, JObject element)
        {
            bool band = true;
            foreach (var node in element)
            {
                if (node.Value.ToString() == "")
                    band = false;
            }
            if (Length != element.Count)
                band = false;
            return band;
        }

    }
}
    }
}
