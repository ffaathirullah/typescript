import React, { useRef } from "react";
import {
  View,
  Text,
  TouchableOpacity,
  SafeAreaView,
  FlatList,
  TouchableWithoutFeedback,
  Image,
  ImageBackground,
  Animated,
  ScrollView,
} from "react-native";
import { dummyData, COLORS, SIZES, FONTS, icons, images } from "../constants";
import { Profiles, ProgressBar } from "../components";
import RenderHead from "./../components/RenderHead";

const Home = ({ navigation }) => {
  const newSeasonScrollX = useRef(new Animated.Value(0)).current;

  function renderNewSeasonSection() {
    return (
      <Animated.FlatList
        horizontal
        pagingEnabled
        snapToAlignment="center"
        snapToInterval={SIZES.width}
        showsHorizontalScrollIndicator={false}
        scrollEventThrottle={16}
        decelerationRate={0}
        contentContainerStyle={{ marginTop: SIZES.radius }}
        data={dummyData.newSeason}
        keyExtractor={(item) => `$${item.id}`}
        onScroll={Animated.event(
          [{ nativeEvent: { contentOffset: { x: newSeasonScrollX } } }],
          { useNativeDriver: false }
        )}
        renderItem={({ item, index }) => {
          return (
            <TouchableWithoutFeedback>
              <View
                style={{
                  width: SIZES.width,
                  alignItems: "center",
                  justifyContent: "center",
                }}
              >
                <ImageBackground
                  source={item.thumbnail}
                  resizeMode="cover"
                  style={{
                    width: SIZES.width * 0.85,
                    height: SIZES.width * 0.85,
                    justifyContent: "flex-end",
                  }}
                  imageStyle={{ borderRadius: 40 }}
                ></ImageBackground>
              </View>
            </TouchableWithoutFeedback>
          );
        }}
      />
    );
  }

  function renderDots() {
    const dotPosition = Animated.divide(newSeasonScrollX, SIZES.width);

    return (
      <View
        style={{
          marginTop: SIZES.padding,
          flexDirection: "row",
          alignItems: "center",
          justifyContent: "center",
        }}
      >
        {dummyData.newSeason.map((item, index) => {
          const opacity = dotPosition.interpolate({
            inputRange: [index - 1, index, index + 1],
            outputRange: [0.3, 1, 0.3],
            extrapolate: "clamp",
          });

          const dotWidth = dotPosition.interpolate({
            inputRange: [index - 1, index, index + 1],
            outputRange: [6, 20, 6],
            extrapolate: "clamp",
          });

          const dotColor = dotPosition.interpolate({
            inputRange: [index - 1, index, index + 1],
            outputRange: [COLORS.lightGray, COLORS.primary, COLORS.lightGray],
            extrapolate: "clamp",
          });

          return (
            <Animated.View
              key={`dot-${index}`}
              opacity={opacity}
              style={{
                borderRadius: SIZES.radius,
                marginHorizontal: 3,
                width: dotWidth,
                height: 6,
                backgroundColor: dotColor,
              }}
            />
          );
        })}
      </View>
    );
  }

  function renderContinueWatchingSection() {
    return (
      <View style={{ marginTop: SIZES.padding }}>
        {/* Header */}
        <View
          style={{
            flexDirection: "row",
            paddingHorizontal: SIZES.padding,
            alignItems: "center",
          }}
        >
          <Text style={{ flex: 1, color: COLORS.white, ...FONTS.h2 }}>
            Live Streaming
          </Text>

          <TouchableOpacity
            onPress={() => navigation.navigate("CategoryScreen")}
          >
            <Image
              source={icons.right_arrow}
              style={{ width: 20, height: 20, tintColor: COLORS.primary }}
            />
          </TouchableOpacity>
        </View>

        {/* List */}
        <FlatList
          horizontal
          showsHorizontalScrollIndicator={false}
          contentContainerStyle={{ marginTop: SIZES.padding }}
          data={dummyData.continueWatching}
          keyExtractor={(item) => `${item.id}`}
          renderItem={({ item, index }) => {
            return (
              <TouchableWithoutFeedback
                onPress={() =>
                  navigation.navigate("MovieDetail", { selectedMovie: item })
                }
              >
                <View
                  style={{
                    marginLeft: index == 0 ? SIZES.padding : 20,
                    marginRight:
                      index == dummyData.continueWatching.length - 1
                        ? SIZES.padding
                        : 0,
                  }}
                >
                  {/* Thumbnail */}
                  <Image
                    source={item.thumbnail}
                    resizeMode="cover"
                    style={{
                      width: SIZES.width / 3,
                      height: SIZES.width / 3 + 60,
                      borderRadius: 20,
                    }}
                  />
                  {/* Name */}
                  <Text
                    style={{
                      marginTop: SIZES.base,
                      color: COLORS.white,
                      ...FONTS.h4,
                    }}
                  >
                    {item.name}
                  </Text>
                </View>
              </TouchableWithoutFeedback>
            );
          }}
        />
      </View>
    );
  }

  return (
    <SafeAreaView style={{ flex: 1, backgroundColor: COLORS.black }}>
      <RenderHead />

      <ScrollView contentContainerStyle={{ paddingBottom: 100 }}>
        {renderNewSeasonSection()}
        {renderDots()}
        {renderContinueWatchingSection()}
      </ScrollView>
    </SafeAreaView>
  );
};

export default Home;
