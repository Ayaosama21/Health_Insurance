import React, {Component} from 'react';
import { View, Text } from 'react-native';
import {Button, Card, CardSection} from './common';
import { Navigation } from 'react-native-navigation';
import ChooseDept from './ChooseDept';
import Test2 from './Test2';


class Choose extends Component {
    GoToReservation = () => {
        Navigation.push('CHOOSE', {
          component: {
            id: 'RESERVTION',
            name: 'RESERVTION',
            options: {
              topBar: {
                title: {
                  text: 'الأقسام                               ',
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

    GoToPrescription = () => {
        Navigation.push('CHOOSE', {
          component: {
            id: 'PRESCRIPTION',
            name: 'PRESCRIPTION',
            options: {
              topBar: {
                title: {
                  text: 'الأقسام                               ',
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

  render() {
    return (
      <Card>
          <CardSection>
            <Button onPress={() => this.GoToReservation(this)}>
                حجز
            </Button>
          </CardSection>
          <CardSection>
            <Button onPress={() => this.GoToPrescription(this)}>
              روشتات 
            </Button>
          </CardSection>
      </Card>
    );
  }
}

    const Reservation = () => {
        return (
        <ChooseDept/>
        );
    }

    const Prescription = () => {
        return (
        <Test2/>
        );
    }

export default Choose;

Navigation.registerComponent('CHOOSE', () => Choose) ;
Navigation.registerComponent('RESERVTION', () => Reservation);
Navigation.registerComponent('PRESCRIPTION', () => Prescription);
