import React, { Component } from 'react';
import { ScrollView } from 'react-native';
import axios from 'axios';
import {Card,CardSection, Button } from '../common';
import AppointmentList from '../appointments/AppointmentList';
import { Navigation } from 'react-native-navigation'; 

class DoctorList extends Component {
  state = { doctors: [] };
  
  DoctorChoose = () => {
    Navigation.push('DoctorList', {
      component: {
        id: 'AppointmentList',
        name: 'AppointmentList',
        options: {
          topBar: {
            title: {
              text: 'المواعيد                               ',
              align: 'right',
              fontSize: 35,
            },
            backButton: {
              visible: false,
              color: '#f8a11b'
            },
          }
        }
      }
    })
  }

  GoToAppointmentList = (props) => {
        alert(props);
        this.DoctorChoose();
  }

  componentDidMount() {
    axios.get('http://system.mgclinic.online/api/doctors?fbclid=IwAR0xzG-XLnxwD0q-6k3bmt7mbId8tdt9kfe-Exj_1ADSpjLZvV8HR4gO1UM')
      .then(response => this.setState({ doctors: response.data }));
  }

  renderdoctors() {
    return this.state.doctors.map(doctor =>
      <Card key={doctor.id} doctor={doctor}>
      <CardSection key={doctor.id} doctor={doctor}>
        <View style={styles.ContainerStyle}>
          <Button onPress={() => this.GoToAppointmentList(this)}>
            {doctor.username}
          </Button>
        </View>
      </CardSection>
    </Card>
    );
  }

  render() {
    console.log(this.state);

    return (
      <ScrollView>
        {this.renderdoctors()}
      </ScrollView>
    );
  }
}

export default DoctorList;

const styles = {
  ContainerStyle: {
    justifyContent: 'center',
    alignItems: 'center',
    marginLeft: 10,
    marginRight: 10,
    flex: 1
  },
}

Navigation.registerComponent('Doctor', () => DoctorList);
Navigation.registerComponent('AppointmentList', () => AppointmentList);
/*
Navigation.events().registerAppLaunchedListener(async () => {
    Navigation.setRoot({
      root: {
        stack: {
          children: [
            {
              component: {
                id: 'DoctorList.js',
                name: 'DoctorList.js'
              }
            }
          ]
        }
      }
    });
  });
  */
// Go to appointment code
  /*
  DoctorChoose = () => {
    Navigation.push('AppointmentList', {
      component: {
        id: 'AppointmentList',
        name: 'AppointmentList',
        options: {
          topBar: {
            title: {
              text: 'المواعيد                               ',
              align: 'right',
              fontSize: 35,
            },
            backButton: {
              visible: false,
              color: '#f8a11b'
            },
          }
        }
      }
    })
  }
  GoToAppointmentList = (props) => {
        alert(props);
        this.DeptChoose();
}
  */