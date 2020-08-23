/*
import React, { Component } from 'react';
import { ScrollView } from 'react-native';
import axios from 'axios';
import Aaa from './aaa';
import { Navigation } from 'react-native-navigation'; 

class APITest extends Component {
  state = { patients: [] };

  componentDidMount() {
    axios.get('https://l.facebook.com/l.php?u=http%3A%2F%2Fsystem.mgclinic.online%2Fapi%2Fpatients%2F1%3Ffbclid%3DIwAR2lWExq5OO55IxCnfmEhrBr1yF8rNR5FMabFuaWkg4r271AZ1Lq3peGmf8&h=AT1_wbDFAYnZQEWbtNWdeoP2mn_KvHFWMWl4CiQNqlZ3wqJxhpMTitPmpfiH-p3Syj6W5fUZu33F15C_F7QkEDBtj5lpOZFzysbInvAsEPuVy0Ux9X4oy0cXHCZORVVCdmwawA')
      .then(response => this.setState({ patients: response.data }));
  }

  renderAlbums() {
    return this.state.patients.map(patient =>
      <Aaa key={patient.id} patient={patient} />
    );
  }

  render() {
    console.log(this.state);

    return (
      <ScrollView>
        {this.renderAlbums()}
      </ScrollView>
    );
  }
}

export default APITest;


Navigation.registerComponent('APITest', () => APITest);

Navigation.events().registerAppLaunchedListener(async () => {
    Navigation.setRoot({
      root: {
        stack: {
          children: [
            {
              component: {
                id: 'APITest',
                name: 'APITest'
              }
            }
          ]
        }
      }
    });
  });
*/

import React, { useEffect, useState } from 'react';
import { ActivityIndicator, FlatList, Text, View } from 'react-native';
import { ScrollView } from 'react-native';
import axios from 'axios';
import { Navigation } from 'react-native-navigation'; 

export default APITest = () => {
  const [isLoading, setLoading] = useState(true);
  const [data, setData] = useState([]);

  useEffect(() => {
    fetch('https://5f394ae141c94900169c042e.mockapi.io/Demo/patient')
      .then((response) => response.json())
      .then((json) => setData(json.movies))
      .catch((error) => console.error(error))
      .finally(() => setLoading(false));
  })

  /*
  useEffect(() => {
    fetch('https://system.mgclinic.online/api/patientLogin', {
      method: 'POST',
      body: JSON.stringify({
        username: "ali",
        password: "12345678"
      })
  })
    //fetch('http://system.mgclinic.online/api/patients/1?fbclid=IwAR1JosdFYysM0Eu99LvzXm74NGvYO9_XPtNPrhxZ7ZRZZjgi5dQiayyTpMs')
    .then((response) => response.json())
    .then((json) => setData(json.movies))
      .catch((error) => console.error(error))
      .finally(() => setLoading(false));    
  }, []);
  */

  return (
    <View style={{ flex: 1, padding: 24 }}>
              <Text>test1</Text>
      {isLoading ? <ActivityIndicator/> : (
        <FlatList
          data={data}
          keyExtractor={({ id }, index) => id}
          renderItem={({ item }) => (
            <Text>{item.username}</Text>
          )}
        />
      )}
              <Text>test2</Text>
    </View>
  );
};

Navigation.registerComponent('APITest', () => APITest);

Navigation.events().registerAppLaunchedListener(async () => {
    Navigation.setRoot({
      root: {
        stack: {
          children: [
            {
              component: {
                id: 'APITest',
                name: 'APITest'
              }
            }
          ]
        }
      }
    });
  });