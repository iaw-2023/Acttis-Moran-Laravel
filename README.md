## Informacion a utilizar

En nuestro proyecto, se eligió de concepto la venta de tickets para partidos de fútbol, disponiendo de un carrito de compras donde se podran añadir tickets de distintos partidos, eligiendo qué tipo de ticket se desea comprar (qué zona del estadio). La busqueda se puede realizar filtrando los partidos segun los equipos que son partícipes, el estadio donde se juega, o ambos.

- Por lo tanto, para llevar a cabo esta aplicacion, se determinaron las siguientes entidades y relaciones : 

     ![Entidad Relacion IAW drawio (5)](https://user-images.githubusercontent.com/42581931/229949218-8c490701-381e-4345-96a7-7090f7572791.png)



### Proyecto Framework PHP - Laravel :

En este proyecto, se implementará un back-end y front-end en Php-Laravel para desarrollar una aplicacion multiple page, con el objetivo de que los administradores de la empresa puedan realizar ABM de las entidades del sistema.
Teniendo en cuenta esto, tendra las siguientes facilidades : 

- Se podran actualizar las siguientes entidades : 
    - Matchgame
    - TeamPlayingMatch
    - Ticket
    - Zone
    
    Se asume que los Team’s y Stadium’s seran predeterminados, es decir, habra un set de equipos con sus respectivos estadios locales sobre los cuales se podran crear partidos.

- Se podran obtener los reportes de las Order’s existentes junto a sus TicketDetail’s, ademas de los Team’s y Stadium’s existentes.

- Se podran obtener por API (a traves de la aplicacion React) las siguientes entidades :
    - Matchgame
    - Team
    - Stadium
    - TeamPlayingMatch
    - Ticket
    - Zone
    
    A partir de ver la informacion de estas entidades (el usuario podrá realizar busqueda filtrando por estadio donde se realiza el partido, o por los equipos que participaran), se podran generar compras (Order’s) las cuales contendran TicketDetail’s asociadas cada una a un Ticket y la cantidad a comprar del mismo.


## Proyecto Javascript - React/Vue

En este proyecto, se desarrollará una aplicacion front-end con React y se incorporará una API en la aplicacion del primer proyecto en Laravel, de forma que la app React pueda obtener informacion del back-end.
Teniendo en cuenta esto, tendra las siguientes facilidades : 

- El usuario podrá observar la siguiente informacion : 
    - Los partidos (Matchgame) que se jugaran, filtrando segun equipo (Team) o estadio (Stadium).
    - Los Ticket's y Zone's (ubicacion en el estadio) del partido seleccionado.
    
- El usuario podrá realizar las siguientes acciones : 
    - Elegir partidos, seleccionar tipo de ticket (Zone) y añadir Ticket al carrito de compras.
    - Quitar tickets existentes del carrito.
    - Efectuar la orden de compra de todos los tickets existentes en el carrito.
