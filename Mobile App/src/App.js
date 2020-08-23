/*
import React from 'react';
import {Provider} from 'react-redux';
import {createStore, applyMiddleware} from 'redux';
import ReduxThunk from 'redux-thunk';
import reducers from './reducers';
import Nav from './Nav';

const App = () => {
  const store = createStore(reducers, {}, applyMiddleware(ReduxThunk));
 return(
   <Provider store={store}>
      <Nav/>
   </Provider>
 );
}

export default App;
*/


 import React from 'react';
import Logz from './Nav';

const App = () => {
 return(
      <Logz/>
 );
}

export default App;

