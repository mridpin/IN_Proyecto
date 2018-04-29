Transformacion: JSON API Example
Qué hace?: Extrae datos de la api (tantos como se pongan en ?limit= en la url del primer nodo), traduce los JSON a tabla, 
selecciona los campos que interesen, agrupa las ofensas en 10 ofensas y escribe el resultado en un CSV

Transformacion: Select distinct offenses
Qué hace?: Transformacion AUXILIAR que hace un SELECT DISTINCT offenses directamente desde la API 
y las imprime en un fichero CSV para ver cuantas hay

Fichero: offense_grouping.csv
Qué contiene?: Una tabla con dos columnas, la ofensa original y su grupo en el que se ha agrupado. 
Este fichero se ha hecho a mano a partir del resultado de la transformacion Select distinct offenses

Fichero: offenses_result.csv
Qué contiene?: Resultado de la transformacion JSON API Example con 5000 filas

Fichero: list_of_offenses.csv
Qué contiene?: Los 10 grupos finales de ofensas. Se obtiene en el Text File Output 3 del la transformacion JSON API Example.
Se obtiene realizando un "select distinct" en la tabla de delitos una vez agrupados estos.

