import React, { Component } from 'react';
import { ScrollView } from 'react-native';
import axios from 'axios';
import { Card, CardSection , Button } from './common';
import AppointmentList from './appointments/AppointmentList';
import { Navigation } from 'react-native-navigation'; 

class DoctorList extends Component {
  state = { doctors: [] };
  _isMounted = false;

  DoctorChoose = (props) => {
    Navigation.push('DOCLIST', {
      component: {
        id: 'AppointmentList',
        name: 'AppointmentList',
        options: {
          topBar: {
            title: {
              text: "Dr "+props,
              align: 'right',
              fontSize: 35,
            },
            backButton: {
              visible: true,
              color: '#000000'
            },
          }
        }
      }
    })
  }

  GoToAppointmentList = (props) => {
        alert("Dr "+ props);
        this.DoctorChoose(props);
  }

  componentDidMount() {
    this._isMounted = true;
    axios.get('http://system.mgclinic.online/api/doctors?fbclid=IwAR0xzG-XLnxwD0q-6k3bmt7mbId8tdt9kfe-Exj_1ADSpjLZvV8HR4gO1UM')
      .then(response => this.setState({ doctors: response.data }));
  }

  componentWillUnmount() {
    this._isMounted = false;
  }

  renderdoctors() {
    return this.state.doctors.map(doctor =>
      <Card key={doctor.id} doctor={doctor}>
      <CardSection 
        key={doctor.id} doctor={doctor}
        style={styles.ContainerStyle}>
          <Button 
            key={doctor.id} doctor={doctor}
            onPress={() => this.GoToAppointmentList(doctor.username)}>
            {doctor.username}
          </Button>
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

const Appointment = () => {
  return (
    <AppointmentList/>
  );
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

Navigation.registerComponent('AppointmentList', () => Appointment);