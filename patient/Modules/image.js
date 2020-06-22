import React, { Component } from 'react';
import {ScrollView,Text,Image,View,StyleSheet} from 'react-native';
class image extends Component {
    static navigationOptions =
      {
         title: 'الروشتات',
      };
    render(){
        return(
        <ScrollView style={styles.scroll}>
            <View style={styles.container}>
                <Image
                    source={require('./1.png')}
                    style={{width:400,height:450}}
                 />
                <Image
                    source={require('./2.png')}
                          style={{ width: 400, height: 450, margin: 16 }}
                />
                <Image
                    source={require('./3.png')}
                    style={{ width: 400, height: 450, margin: 16 }}
                />
                <Image
                    source={require('./4.png')}
                    style={{ width: 400, height: 450, margin: 16 }}
                />
                <Image
                    source={require('./5.png')}
                    style={{ width: 400, height: 450, margin: 16 }}
                />
                <Image
                    source={require('./6.png')}
                    style={{ width: 400, height: 450, margin: 16 }}
                />
                <Image
                    source={require('./7.png')}
                    style={{ width: 400, height: 450, margin: 16 }}
                />
                <Image
                     source={require('./8.png')}
                     style={{ width: 400, height: 450, margin: 16 }}
                />
                <Image
                     source={require('./9.png')}
                     style={{ width: 400, height: 450, margin: 16 }}
                />
            </View>
        </ScrollView>
         );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        alignItems: 'center',
        justifyContent: 'center',
        paddingTop: 40,
        backgroundColor: '#ecf0f1',
      },
    scroll:{
        flex:1,
        backgroundColor:'#ecf0f1',
    }
});

export default image;