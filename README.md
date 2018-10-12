# dm anketa

## Setup Local Project

- make dir e.g. dm_anketa
- clone https://github.com/massvisionnet/cmass.git to dm_anketa/cmass directory
- clone https://github.com/massvisiondotnet/anketa.git to dm_anketa/anketa
- clone https://github.com/massvisionnet/abstractions.git to dm_anketa/abstractions directory
- clone https://github.com/massvisionnet/anvil_old.git to dm_anketa/anvil directory

- start docker: in dm_anketa/anketa run __docker-compose up__
- connecting to db: from same dir, _mysql -h127.0.0.1 -P3398 -uanketa -pdocker_
- connecting to docker: docker exec -it anketa-web /bin/bash
- site is at  
  http://localhost:83
- burning docker images: <br>
      docker stop $(docker ps -a -q)  <br>
      docker rm $(docker ps -a -q) <br>
      docker rmi $(docker images -q) <br>
- view error log:
  docker logs -f anketa-web >/dev/null
