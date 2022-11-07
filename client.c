#include <stdio.h>
#include <stdlib.h>

#include <sys/socket.h>
#include <netinet/in.h> 

#define PORT 100
#define HOST "127.0.0.1"

typedef int SOCKET;
typedef struct sockaddr_in SOCKADDR_IN;
typedef struct sockaddr SOCKADDR;
typedef struct in_addr IN_ADDR;

void connectSocket(){
    SOCKET sock = socket(AF_INET, SOCK_STREAM, 0);
    if (socket == INVALID_SOCKET){
        perror("socket invalide");
        exit(0);
    }
    else {
        sin.sin_addr.s_addr = inet_addr("127.0.0.1");
        sin.sin_family = AF_INET;
        sin.sin_port = htons(PORT);
    }
    if(connect(sock, (SOCKADDR*)&sin, sizeof(sin)) != SOCKET_ERROR)
        printf("Connexion à %s sur le port %d\n",inet_ntoa(sin.sin_addr),htons(sin.sin_port));
    else
        printf("Connexion impossible\n");
    }

void main(){
    connectSocket();
    closesocket(socket);
}
