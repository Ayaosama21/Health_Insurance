import React from 'react';
import {Text,View,Button} from 'react-native';
import {NavigationContainer} from '@react-navigation/native';
import {createStackNavigator} from '@react-navigation/stack';
//const util = require('util');

export default class SecondScreen extends Component {
    static navigationOptions = {
        title: 'Second screen',
    };

    render() {
        return (
            <View>
                <Text>الروشتات</Text>
            </View>
        );
    }
}