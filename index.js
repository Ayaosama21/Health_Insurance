/**
 * @format
 */

import React , {Component} from 'react';
import {View,Text,StyleSheet,FlatList,TouchableOpacity,Dimensions,Image} from 'react-native';
import {ActionSheet,Root} from "native-base";
import ImagePicker from 'react-native-image-crop-picker';
import App from './App';
import Camera from './App/camera_gallery'
import camera_gallery from './App/camera_gallery'
import {name as appName} from './app.json';

const todo = () => {
    return(
            <Camera></Camera>
    );
}

AppRegistry.registerComponent('HealthInsurance', () => todo);
