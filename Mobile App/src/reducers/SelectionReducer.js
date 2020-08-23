export default (state = null, action) => {
    switch (action.type) {
      case 'select_Department':
        return action.payload;
      default:
        return state;
    }
  };
  