/*
import React, {Component} from 'react';
import { View,Text } from 'react-native';
import { Card, CardSection, Input,Button, Spinner } from './common';
import { Navigation } from 'react-native-navigation';
import Choose from './Choose';

class Logz extends Component {

      SuccessLogin = () => {
        Navigation.push('LOGZ', {
          component: {
            id: 'CHOOSE',
            name: 'CHOOSE',
            options: {
              topBar: {
                title: {
                  text: 'الأقسام                               ',
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

      GoToDeptList = () => {
          if ((this.state.email === 'ali') && (this.state.password === '12345678'))
          {
            alert('تم التسجيل');
            this.SuccessLogin(this);
          }
          else {alert('خطأ فى التسجيل')}
            
      }

    renderButton() {
        if (this.props.loading) {
            return <Spinner size = "large" />
        }
        return(
            <Button onPress={() => this.GoToDeptList(this)}>
                تسجيل الدخول    
            </Button> 
        );
    }

    render(){
        return(
            <Card>
                <CardSection>
                  <View style={styles.headerContentStyle}>
                  <Input 
                        
                        placeholder="user@gmail.com"
                        label="اسم المستخدم"
                        onChangeText={email => this.setState({ email })}
                        value={this.props.email}

                    />
                  </View>
                    
                </CardSection>

                <CardSection>
                    <Input 
                        secureTextEntry
                        placeholder="كلمة السر"
                        label="كلمة السر"
                        onChangeText={password => this.setState({ password })}
                        value={this.props.password}
                    />
                </CardSection>

                <Text style={styles.errorTextStyle}>
                    {this.props.error}
                </Text>

                <CardSection>
                    {this.renderButton()}
                </CardSection>
            </Card>
        );
    }
}

const styles = {
  headerContentStyle: {
    flexDirection: 'column',
    justifyContent: 'flex-start',
    height: 120,
  },
    errorTextStyle: {
        fontSize: 20,
        alignSelf: 'center',
        color: 'red'
    },
    textStyle: {
      justifyContent: 'flex-start',
      flexDirection: 'row-reverse',
    }
}

Logz.options = {
    topBar: {
      title: {
        text: 'تسجيل الدخول                               ',
        fontSize: 35,
      }
    }
  };

const DeptList = () => {
    return (
      <Choose/>
    );
  }

export default Logz;

Navigation.registerComponent('Logz', () => Logz) ;
Navigation.registerComponent('CHOOSE', () => DeptList);

Navigation.events().registerAppLaunchedListener(async () => {
    Navigation.setRoot({
      root: {
        stack: {
          children: [
            {
              component: {
                id: 'LOGZ',
                name: 'Logz'
              }
            }
          ]
        }
      }
    });
  });
*/
import React, {Component} from 'react';
import { View,Text } from 'react-native';
import { Card, CardSection, Input,Button, Spinner } from './common';
import { Navigation } from 'react-native-navigation';
import ChooseDept from './ChooseDept';
import Dlist from './DList';
import LabDept from './LabDept';
import DepartmentPicker from './Aya/AyaPre';
//import Test3 from './Test3';

class Logz extends Component {

      SuccessLogin = () => {
        Navigation.setRoot(mainRoot)
      }

      GoToDeptList = () => {
          if ((this.state.email === 'ali') && (this.state.password === '12345678'))
          {
            alert('تم التسجيل');
            this.SuccessLogin(this);
          }
          else {alert('خطأ فى التسجيل')}
            
      }

    renderButton() {
        if (this.props.loading) {
            return <Spinner size = "large" />
        }
        return(
            <Button onPress={() => this.GoToDeptList(this)}>
                تسجيل الدخول    
            </Button> 
        );
    }

    render(){
        return(
            <Card>
                <CardSection>
                  <View style={styles.headerContentStyle}>
                  <Input 
                        
                        placeholder="user@gmail.com"
                        label="اسم المستخدم"
                        onChangeText={email => this.setState({ email })}
                        value={this.props.email}

                    />
                  </View>
                    
                </CardSection>

                <CardSection>
                    <Input 
                        secureTextEntry
                        placeholder="كلمة السر"
                        label="كلمة السر"
                        onChangeText={password => this.setState({ password })}
                        value={this.props.password}
                    />
                </CardSection>

                <Text style={styles.errorTextStyle}>
                    {this.props.error}
                </Text>

                <CardSection>
                    {this.renderButton()}
                </CardSection>
            </Card>
        );
    }
}

const styles = {
  headerContentStyle: {
    flexDirection: 'column',
    justifyContent: 'flex-start',
    height: 120,
  },
    errorTextStyle: {
        fontSize: 20,
        alignSelf: 'center',
        color: 'red'
    },
    textStyle: {
      justifyContent: 'flex-start',
      flexDirection: 'row-reverse',
    }
}

Logz.options = {
    topBar: {
      title: {
        text: 'تسجيل الدخول                               ',
        fontSize: 35,
      }
    }
  };

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
  }

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

export default Logz;

Navigation.registerComponent('Logz', () => Logz) ;
Navigation.registerComponent('RESERVTION', () => Reservation) ;
Navigation.registerComponent('DPICK', () => Presecription);
Navigation.registerComponent('LAB', () => Lab);
Navigation.registerComponent('DOCLIST', () => Doc);

Navigation.events().registerAppLaunchedListener(async () => {
  Navigation.setRoot({
    root: {
      stack: {
        children: [
          {
            component: {
              id: 'LOGZ',
              name: 'Logz'
            }
          }
        ]
      }
    }
  });
});

  const mainRoot = {
    root: {
      bottomTabs: {
        children: [
          {
            stack: {
              children: [
                {
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
                    name: 'DPICK'
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
  