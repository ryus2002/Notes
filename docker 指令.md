docker ps  觀看所有 docker 容器

```bash
docker ps 
docker top <container_id>
```

docker pull image  拉取 鏡像檔

```docker
docker pull name:tag
ex:
docker pull php:7.4.19-fpm-alpine3.13
```

docker pull image  上傳 鏡像檔

```
docker tag mytomcat jackyohhub/mytomcat
docker tag ${Image Name} DockerHub帳號/Image Name

docker push jackyohhub/mytomcat
```

docker network

```docker
# 所有 docker 網路配置
docker network ls

# 指定詳細顯示 network 細節
docker network inspect network_id
```

清除本地 無使用鏡像檔

```docker
docker image prune
docker volume prune
docker container prune

----- all in one -----
docker system prune
```

docker rebuild  重建鏡像檔

```docker
docker-compose up -d --no-deps --build <service_name>

--no-deps - Don't start linked services.

--build - Build images before starting containers.
```

docker compose 指令

```bash
#依照 docker-compose.yml 啟動容器
docker-compose up -d 

#依照 docker-compose.yml 關閉容器
docker-compose down 
```

查 container IP
```
docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' container_name_or_id
```
