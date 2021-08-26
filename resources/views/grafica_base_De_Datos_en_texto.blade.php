|pacientes|		 |municipios|
|		  |1 => 1|			|
|		  |N <= 1|			|
|		  |		 |__________|
|municipio| -> foreign key
|_________|

| Articulo|		 | Escritor |
|		  |1 => 1|			|
|		  |N <= 1|			|
|_________|		 |__________|

$escritores = Writer::with('articles')->get();