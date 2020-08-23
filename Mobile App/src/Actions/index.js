import React from 'react';
import {Text} from 'react-native';
//import axios from 'axios';
import { 
    EMAIL_CHANGED,
    PASSWORD_CHANGED,
    LOGIN_USER_SUCCESS,
    LOGIN_USER_FAIL,
    LOGIN_USER   
} from './types';

const QUOTE_REQUESTED = "QUOTE_REQUESTED";

export const emailChanged = (text) => {
    return {
        type: EMAIL_CHANGED,
        payload: text
    };
};

export const passwordChanged =(text) => {
    return {
        type: PASSWORD_CHANGED,
        payload: text
    };
};

export const LoginUser = ({email, password}) => {          
    return (dispatch) => {
        dispatch({ type: LOGIN_USER });
    }
};

const loginUserFail = (dispatch) => {
    dispatch({type: LOGIN_USER_FAIL});
};

const loginUserSuccess = (dispatch, user) => {
    dispatch({
        type: LOGIN_USER_SUCCESS,
        payload: user
    });
}