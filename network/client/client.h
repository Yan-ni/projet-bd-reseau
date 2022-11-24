#ifndef __CLIENT__H__
#define __CLIENT__H__

#include<stdio.h>
#include <stdlib.h>
#include<string.h>
#include <stdbool.h>
#include<sys/socket.h>
#include<arpa/inet.h>
#include <unistd.h>

int create_socket(char* host, int port);

#endif