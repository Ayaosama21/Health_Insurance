import React, { Component } from 'react';
import {ScrollView,Text,Image,View,StyleSheet} from 'react-native';
import ChooseDept from './ChooseDept';
import DepartmentPicker from './Aya/AyaPre';
import Dlist from './DList';
import LabDept from './LabDept';
import {Card , Button, CardSection} from './common';
import { Navigation } from 'react-native-navigation';


class LabView extends Component {

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

    render(){
        return(
            <ScrollView style={styles.scroll}>
                <View style={styles.container}>
                    <Image
                        source={require('./Aya/5.png')}
                        style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                        source={require('./Aya/6.png')}
                        style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                        source={require('./Aya/7.png')}
                        style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                         source={require('./Aya/8.png')}
                         style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                         source={require('./Aya/9.png')}
                         style={{ width: 400, height: 450, margin: 16 }}
                    />
                </View>
                <CardSection>
                    <Button onPress={() => this.GoHome()}>
                        رجوع
                    </Button>
                </CardSection>

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

export default LabView;

const styles = StyleSheet.create({
    container: {
        flex: 1,
        alignItems: 'center',
        justifyContent: 'center',
        paddingTop: 40,
        backgroundColor: '#ecf0f1',
      },
    scroll:{
        flex:1,
        backgroundColor:'#ecf0f1',
    }
});
Navigation.registerComponent('LAB', () => Lab);
Navigation.registerComponent('RESERVTION', () => Reservation) ;
Navigation.registerComponent('TEST3', () => Presecription);
Navigation.registerComponent('DOCLIST', () => Doc);



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
};

/*
render(){
        return(
            <ScrollView style={styles.scroll}>
                <View style={styles.container}>
                    <Image
                        source={require('./1.png')}
                        style={{width:400,height:450}}
                     />
                    <Image
                        source={require('./2.png')}
                              style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                        source={require('./3.png')}
                        style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                        source={require('./4.png')}
                        style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                        source={require('./5.png')}
                        style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                        source={require('./6.png')}
                        style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                        source={require('./7.png')}
                        style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                         source={require('./8.png')}
                         style={{ width: 400, height: 450, margin: 16 }}
                    />
                    <Image
                         source={require('./9.png')}
                         style={{ width: 400, height: 450, margin: 16 }}
                    />
                </View>
                <CardSection>
                    <Button>رجوع</Button>
                </CardSection>

            </ScrollView>
             );
    }
}
*/