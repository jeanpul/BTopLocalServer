//
// Author: fabien pelisson
//

// 
// params
// remoteChannel (STRING) : the channel id
// remoteHost (STRING) : the host or ip adress
function BTopLocalServer_viewBTopSensorConfig(remoteChannel, remoteHost)
{
  window.open('http://' + remoteHost + '/cgi-bin/Sensor/Test.cgi?ChannelId=' + remoteChannel + '&mode=1', 'Sensor remote configuration', 'width=800,height=600,location=no');
}
