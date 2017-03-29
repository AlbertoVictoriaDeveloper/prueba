######################
Desarrollo ParanoidSW
######################

Antes de hacer alguna implementación dentro de ParanoidSW Asegurate de tener ya levantado el ambiente virtual
que puedes clonar de Oblak_virtual_machine.

*************
Configuración
*************

ParanoidSW ya esta configurado por defecto para ser utilizado dentro del ambiente virtual de vagrant pero en caso
de que tu necesites realizar un deploy, tu puedes modificar las credenciales de la base de datos y el base_url
para que se pueda conectar a la base de datos del ambiente de desarrollo.

**************
¡No lo olvides!
**************

Recuerda que cada modificación en la base de datos debe de ser notificada para su pronta actualización ya que si no es notificada
puede causar un conflicto en la implementación para otros desarrolladores.

Cuando desarrolles alguna implementación en los proyectos, te recomendamos que no trabajes sobre la rama master, al contrario
crea una rama derivada de esta para poder trabajar y despues de haber hecho tu implementación subela a tu rama de forma remota,
prueba y verifica el funcionamiento de tu desarrollo para que no exista complicaciones al ser mezclada con la rama master.

Importante: Cuando generes una rama, NO uses tu nombre o palabras que no tengan contexto en el desarrollo ya que puede provocar confusión en el
desarrollo. Tambien al momento de realizar un commit se recomienda explicar brevemente lo que se realizo en dicho commit para tener una explicacion de lo que 
se hizo en caso de que otro desarrollador requiera de tu commit.