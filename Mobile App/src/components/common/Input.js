import React from 'react';
import {TextInput, Text, View } from 'react-native';

const Input = ({label, value, onChangeText, placeholder, secureTextEntry}) => {
    const { inputStyle, labelStyle, containerStyle } = styles;

    return (
        <View style={containerStyle}>
            <Text style={labelStyle}>{label}</Text>
            <TextInput
                secureTextEntry={secureTextEntry}
                placeholder={placeholder}
                autoCorrect={false}
                style={inputStyle}
                value={value}
                onChangeText={onChangeText}
            />
        </View>
    )
}

const styles = {
    inputStyle: {
        color: '#000',
        paddingRight: 5,
        paddingLeft: 5,
        fontSize: 35,
        lineHeight: 23,
        height: 70,
        //alignItems: 'flex-end',
        flex: 1
    },

    labelStyle: {
        paddingRight: 10,
        paddingLeft: 5,
        fontSize: 35,
        height: 70,
        alignItems: 'flex-end',
        flex: 1
    },

    containerStyle: {
        height: 150,
        flex: 1,
        flexDiriction: 'row-reverse',
        justifyContent: 'flex-end',
        alignItems: 'flex-end'

    }
};

export {Input};