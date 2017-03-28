var http=require('http').Server();
var io=require('socket.io');
var Redis=require('ioredis');
var redis =new Redis();
redis.subscribe('test-channel');

redis.on('message',function(){

})