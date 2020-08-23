/*
import React, { Component } from 'react';
import { ScrollView } from 'react-native';
import axios from 'axios';
import { Card, CardSection , Button } from '../common';
//import { Navigation } from 'react-native-navigation'; 

class AppointmentList extends Component {
  state = { appointments: [] };

  componentDidMount() {
    axios.get('http://system.mgclinic.online/api/doctors?fbclid=IwAR0xzG-XLnxwD0q-6k3bmt7mbId8tdt9kfe-Exj_1ADSpjLZvV8HR4gO1UM')
      .then(response => this.setState({ appointments: response.data }));
  }

  GoToAppointmentList = (props) => {
    alert("Dr "+ props);
    //this.DoctorChoose();
  } 

  renderAppointment() {
    return this.state.appointments.map(appointment =>
      <Card key={appointment.id} appointment={appointment}>
      <CardSection 
        key={appointment.id} appointment={appointment}
        style={styles.ContainerStyle}>
          <Button 
          onPress={() => this.GoToAppointmentList(appointment.username)}
          style={styles.ContainerStyle}>
            {appointment.username}
          </Button>
      </CardSection>
    </Card>
    );
  }

  render() {
    console.log(this.state);

    return (
      <ScrollView>
        {this.renderAppointment()}
      </ScrollView>
    );
  }
}

export default AppointmentList;

const styles = {
  ContainerStyle: {
    justifyContent: 'center',
    alignItems: 'center',
    marginLeft: 10,
    marginRight: 10,
    flex: 1
  },
}
*/

import React,{Component} from 'react';
import { Text, View, ScrollView, Alert } from 'react-native';
import { Button, CardSection,Card } from '../common';
import ChooseDept from '../ChooseDept';
import DepartmentPicker from '../Aya/AyaPre';
import LabDept from '../LabDept';
import { Navigation } from 'react-native-navigation';

class AppointmentList extends Component {

  GoHome = () => {
    Navigation.setRoot({
      root: {
        bottomTabs: {
          children: [
            {
              stack: {
                children: [
                  {
                    component: {
                      name: 'DOCLIST'
                    },
                    component: {
                      name: 'RESERVTION'
                    }
                  },
                ]
              }
            },
            {
              stack: {
                children: [
                  {
                    component: {
                      name: 'TEST3'
                    }
                  }
                ]
              }
            },
            {
              stack: {
                children: [
                  {
                    component: {
                      name: 'LAB'
                    }
                  },
                ]
              }
            }
          ]
        }
      }
  });
  }

  SuccessRes = () => {
    alert('تم تأكيد الحجز');
    this.GoHome(this);
  }

  Resrevation = () => {
    Alert.alert(
      'تأكيد',
      'لا يمكن الغاء الحجز و لا يمكن حجز فى نفس القسم لمدة شهر، هل انت متأكد من اتمام عملية الحجز؟',
      [
        {
          text: 'تأكيد الحجز',
          onPress: () => this.SuccessRes()
        },
        {
          text: 'لا',
          onPress: () => console.log('Cancel Pressed'),
          style: 'cancel'
        }
      ],
      { cancelable: false }
    );
  }

  renderButton() {
    return(
        <Button onPress={() => this.Resrevation(this)}>
            حجز    
        </Button> 
    );
  }

  render(){
    return(
      <ScrollView>
        <Card>
            <CardSection><Text style={styles.textStyle}>الاثنين 21/09</Text></CardSection>
            <CardSection><Text style={styles.textStyle}>من 8am الي 1pm</Text></CardSection>
            <CardSection><Text style={styles.textStyle}>العدد المتبقي : 8</Text></CardSection>
            <CardSection>{this.renderButton()}</CardSection>
        </Card>
        <Card>
            <CardSection><Text style={styles.textStyle}>الاربعاء 23/09</Text></CardSection>
            <CardSection><Text style={styles.textStyle}>من 8am الي 1pm</Text></CardSection>
            <CardSection><Text style={styles.textStyle}>العدد المتبقي : 10</Text></CardSection>
            <CardSection>{this.renderButton()}</CardSection>
        </Card>
      </ScrollView>
    );
  }
}

const Reservation = () => {
  return (
    <ChooseDept/>
  );
}
Reservation.options = {
  topBar: {
    title: {
      text: 'الحجز                               ',
      fontSize: 35
    }
  },
  bottomTab: {
    text: 'حجز'
  }
};

const Presecription = () => {
  return (
    <DepartmentPicker/>
  );
}
const Doc = () => {
  return (
    <Dlist/>
  );
}

Presecription.options = {
  topBar: {
    title: {
      text: 'روشتات                               ',
      fontSize: 35
    }
  },
  bottomTab: {
    text: 'الروشتات'
  }
};

const Lab = () => {
  return (
    <LabDept/>
  );
}

Lab.options = {
  topBar: {
    title: {
      text: 'المعامل                               ',
      fontSize: 35
    }
  },
  bottomTab: {
    text: 'المعامل'
  }
}

export default AppointmentList;

Navigation.registerComponent('LAB', () => Lab);
Navigation.registerComponent('RESERVTION', () => Reservation) ;
Navigation.registerComponent('TEST3', () => Presecription);
Navigation.registerComponent('DOCLIST', () => Doc);

const styles = {
  textStyle: {
      color:'#000000',
      fontSize: 30,
      fontWeight:'600',
      paddingTop: 10,
      paddingBottom:10
  }
}

const mainRoot = {
  root: {
    bottomTabs: {
      children: [
        {
          stack: {
            children: [
              {
                component: {
                  name: 'DOCLIST'
                },
                component: {
                  name: 'RESERVTION'
                }
              },
            ]
          }
        },
        {
          stack: {
            children: [
              {
                component: {
                  name: 'TEST3'
                }
              }
            ]
          }
        }
      ]
    }
  }
};