import React, { Component } from 'react';
//import {diseaesList} from './Modules/diseaesList';
class diseaesList extends Component{
static navigationOptions =
  {
     title: 'اختار القسم',
  };

  FunctionToOpenSecondActivity = () =>
    {
       this.props.navigation.navigate('Second');

    }

    render(){
        return(
            <View style = {styles.MainContainer}>
                <View Style={{marginBottom: 20}}>
                    <Text style = { styles.TextStyle }> اختار القسم المطلوب </Text>
                </View>
                <Button onPress = {this.FunctionToOpenSecondActivity} title='الروشتات'/>
            </View>
            );
    }
}