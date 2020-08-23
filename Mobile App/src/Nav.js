//import { Navigation } from "react-native-navigation";
import React,{Component} from 'react';
import Logz from './components/Logz';
//import Test from './components/Test';

class Nav extends Component {
    render() {
        return(
            <Logz/>
        );
    }
  }

export default Nav;

/*
Navigation.registerComponent('Logz', () => Logz) ;
Navigation.registerComponent('DeptList', () => DeptList);
Navigation.events().registerAppLaunchedListener(async () => {
    Navigation.setRoot({
        root: {
            stack:{
                children: [
                    {
                        component: {
                            name: 'Logz'
                        }
                    }
                ]
            }
        }
    });
});
*/

/*
import { Navigation } from "react-native-navigation";
import React,{Component} from 'react';
import LoginForm from './components/LoginForm';

class Nav extends Component {
    render() {
        return(
            <LoginForm/>
        );
    }
  }

export default Nav;

Navigation.registerComponent('LoginForm', () => LoginForm) ;
Navigation.events().registerAppLaunchedListener(async () => {
    Navigation.setRoot({
        root: {
            stack:{
                children: [
                    {
                        component: {
                            name: 'LoginForm'
                        }
                    }
                ]
            }
        }
    });
});
*/


/*
import { Navigation } from "react-native-navigation";
import React,{Component} from 'react';
import {Provider} from 'react-redux';
import {createStore, applyMiddleware} from 'redux';
import ReduxThunk from 'redux-thunk';
import reducers from './reducers';
import LoginForm from './components/LoginForm';

class Nav extends Component {
    render() {
        const store = createStore(reducers, {}, applyMiddleware(ReduxThunk));
        return(
            <Provider store={store}>
                <LoginForm/>
            </Provider>
        );
    }
  }

export default Nav;

Navigation.registerComponent('LoginForm', () => LoginForm) ;
Navigation.events().registerAppLaunchedListener(async () => {
    Navigation.setRoot({
        root: {
            stack:{
                children: [
                    {
                        component: {
                            name: 'LoginForm'
                        }
                    }
                ]
            }
        }
    });
});
*/