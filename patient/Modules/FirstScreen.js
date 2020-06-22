import * as React from 'react';
import {Platform,StyleSheet,Text,View,Button} from 'react-native';
import {NavigationContainer} from '@react-navigation/native';
import {createStackNavigator} from '@react-navigation/stack';
//const util = require('util');

export default class FirstScreen extends Component {
    render(){
        //console.log("this.props.navigation = "+ util.inspect(this.props.navigation,false,null));
        //var {navigate}=this.props.navigation;
        return(
            <View>
                <Text>اختار القسم </Text>
                <Button
                    onPress={() =>this.props.navigation.navigate("Second")}
                    title = "الروشتات"
                />
            </View>
        );
    }
}